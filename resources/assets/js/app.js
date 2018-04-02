
require('./bootstrap');

window.Vue = require('vue');
/*vue chat scroll */
import Vue from 'vue'
import VueChatScroll from 'vue-chat-scroll'
Vue.use(VueChatScroll)
/*vue chat scroll */

/*vue toaster */
import Toaster from 'v-toaster'
 
// You need a specific loader for CSS files like https://github.com/webpack/css-loader
import 'v-toaster/dist/v-toaster.css'
// optional set default imeout, the default is 10000 (10 seconds).
Vue.use(Toaster, {timeout: 3000})

/*vue toaster ends*/
// Vue.component('example-component', require('./components/ExampleComponent.vue'));
Vue.component('message', require('./components/Message.vue'));

const app = new Vue({
    el: '#app',
    data:{
    	message:'',
    	chat:{
    		message:[],
    		user:[],
    		color:[],
    		time:[]
    	},
    	typing:'',
        noOfUsers:0
    },
    watch:{
    	message(){

    		Echo.private('chat')
		    .whisper('typing', {
		        msg: this.message
		    });
    	}
    },
    methods:{
    	send(){
    		if(this.message.length!=0){
    			this.chat.message.push(this.message);
    			this.chat.user.push('You');
    			this.chat.color.push('success');
    			this.chat.time.push(this.getTime());

                axios.post('/send', {
				    message:this.message,
				    user:this.user,
				    chat:this.chat
				  })
				  .then(response=> {
				    // console.log(response);
				    this.message='';
				  })
				  .catch(error => {
				    console.log(error);
				 });

				  let div = document.getElementById('chat_ul');
                div.scrollTop = div.scrollHeight-div.clientHeight;
    		}
    	},
    	getTime(){
    		let time = new Date();
    		return time.getHours()+':'+time.getMinutes()+':'+time.getSeconds();
    	},
        getOldMessage(){
            axios.post('/getOldMessage')
                  .then(response=> {
                    // console.log(response);
                    console.log(response);
                    if(response.data!=''){
                        this.chat=response.data;
                    }
                  })
                  .catch(error => {
                    console.log(error);
                 });
        },
        deleteSession(){
            axios.post('/clear-chat')
                  .then(response=> {
                    this.$toaster.success(" Chat history cleared.");
                  });
        }
    },
    mounted(){
        this.getOldMessage();
        console.log(this.getOldMessage);
    	Echo.private('chat')
	    .listen('ChatEvent', (e) => {
	    	// console.log(e.user);
	    	this.chat.message.push(e.message);
	    	this.chat.user.push(e.user.name);
	    	this.chat.color.push('warning');
	    	this.chat.time.push(this.getTime());
            axios.post('/saveToSession',{
                chat:this.chat
            })
                  .then(response=> {
                    // if(response.data!=''){
                    //     this.chat=response.data;
                    // }
                  })
                  .catch(error => {
                    console.log(error);
                 });
	    
	    })
	    .listenForWhisper('typing', (e) => {
       		if(e.msg!=''){
                 this.typing='Typing.'
                 
       			}else{
       				this.typing=''
       			}
    	})

            Echo.join(`chat`)
        .here((users) => {
            this.noOfUsers=users.length;

        })
        .joining((user) => {
            // console.log(user.name);
            this.noOfUsers +=1;
            this.$toaster.info(user.name+" Joined Chatroom");
        })
        .leaving((user) => {
            this.noOfUsers -=1;
            this.$toaster.warning(user.name+" Leaved Chatroom");
            // console.log(user.name);
        });
    }
});

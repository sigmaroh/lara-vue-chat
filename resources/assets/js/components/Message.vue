<template>
    <div>
        <li class="list-group-item" :class="className">
            <p class="badge pull-left":class="badgeClassName">{{ user }}
            
            </p>
            <div>
                <slot></slot>
                <span class="badge":class="badgeClassName" style="font-family:monospace;float:right!important">{{ time }}</span>
            </div>
        </li>
        
        
    </div>
</template>

<script>
    export default {
        props:[
            'color',
            'user',
            'time',
        ],
        computed:{
            className(){
                return 'list-group-item-'+this.color;
            },
            badgeClassName(){
                return 'badge-'+this.color;
            }
        },
        mounted() {
            console.log('Component mounted.')
        }
    }
</script>

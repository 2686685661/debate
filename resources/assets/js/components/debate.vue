<template>
    <div class="content fix">
        <mt-header title="固定在顶部"></mt-header>
        <div class="pk box">
            <div class="left">正方：50人</div>
            <div class="pk_text">PK</div>
            <div class="right">反方：50人</div>
        </div>
        <!-- <mt-progress :value="20" :bar-height="35"></mt-progress>
         -->
         <div class="progress">
            <div class="progress-bar progress-bar-striped active" role="progressbar" aria-valuenow="45" aria-valuemin="0" aria-valuemax="100" style="width: 50%">
                <span class="sr-only">45% Complete</span>
            </div>
            <div class="progress-bar progress-bar-striped progress-bar-success active right_color" role="progressbar" aria-valuenow="45" aria-valuemin="0" aria-valuemax="100" style="width: 50%">
                <span class="sr-only">45% Complete</span>
            </div>
        </div>

        <div class="block_button box">
            <mt-button size="normal" type="primary">支持正方</mt-button>
            <mt-button size="normal" type="danger">支持反方</mt-button>
        </div>

        <div class="message">
            <ul class="list-group" id="ul_message">
                <!-- <li class="list-group-item" v-for="(item,index) in returnDta" :key="index">
                    <span class="label label-primary" v-if="item.type == 0">正方</span>
                    <span class="label label-danger" v-else>反方</span>
                    <span>{{ item.name}}: {{ item.context }}</span>   
                </li> -->
            </ul>
        </div>

        <div class="form">
            <input class="input" type="text" placeholder="Username" >
            <mt-button class="button" size="normal" type="danger">发送</mt-button>
        </div>

    </div>
</template>

<script>
    import { Progress,Header, Button } from 'mint-ui';
    export default {
        data() {
            return {
                messageData: [],
                returnDta:[],
                ID: 0
            }
        },
        methods: {
            getData() {
                let _this = this;
                axios.post('',{
                    'id': _this.ID
                })
                .then((response)=> {
                    if(response.data.code == 0) {
                        _this.ID = response.data.result[response.data.result.length -1].id;
                        _this.messageData.concat(response.data.result);
                    }
                });
            },
            setTimingData() {
                var _this = this;
                setInterval(_this.getData(),3000);
            },
            getLiDom(item) {
                var styles = [
                    {class:'label label-primary', text:'未选择'},
                    {class:'label label-primary', text:'正方'},
                    {class:'label label-danger', text:'反方'}
                ];
                var li = document.createElement("li");
                var span1 = document.createElement("span");
                var span2 = document.createElement("span");
                //0没有选择，1正，2反
                li.setAttribute('class', 'list-group-item');
                span1.setAttribute('class', styles[item.type].class);
                span1.innerHTML = styles[item.type].text;
                span2.innerHTML = item.name + ': ' + item.context;

                li.appendChild(span1);
                li.appendChild(span2);
                
                return li;
            },
            setLiDom(index) {
                let ul = document.getElementById('ul_message');
                let liArr = ul.children;
                let _this = this;
                if(liArr.length >= 1)
                    ul.removeChild(liArr[0]);
                if(index == 0) 
                    this.returnDta.forEach((item, index) => {
                        ul.appendChild(_this.getLiDom(item));
                    });
                else 
                    ul.appendChild(this.getLiDom(this.returnDta[this.returnDta.length - 1]));
                
            },
            setTimingDom() {
                let _this = this;
                let index = 0;
                let length = 4;
                setInterval(() => {
                    if(_this.messageData.length < 5) _this.returnDta = _this.messageData;
                    else {
                        _this.returnDta = _this.messageData.slice(index, index+legth);
                    } 
                    _this.setLiDom(index);
                    ++index;
                }, 1500);
            }
        },
        mounted() {
            this.getData();
            this.setTimingData();
            this.setTimingDom();
        }
    }
</script>

<style>

    label {
        display:inline!important;
        font-weight:100;
    }

    .mt-progress-runway {
        background-color: red !important;
        border-radius: 4px !important;
    }
    .box {
        display: flex;
        display: -webkit-flex; /* Safari */
        flex-direction:row;
        justify-content:space-between;
        align-items:center;
    }
    .pk {
        
        width: 100%;
        /* height: 3em; */
        /* flex-grow:1; */
        margin-top: 10%;
        margin-bottom: 2%;
    }
    .left, .right  {
        /* width: 30%; */
        text-align: center;
        font-size: 25px;
        flex-grow:2;
    }
    .block_button .mint-button {
        height: 60px!important;
    }
    .pk_text {
        flex-grow:1;
        font-size: 30px;
        text-align: center;
    }
    .mint-header-title {
        overflow: visible !important;
    }
    .block_button {
        margin-top: 15%;
    }
    .mint-button {
        width: 35% !important;
    }
    .message {
        margin-top: 20%;
        width: 100%;
        height: 12em;
        /* background: red; */
    }
    .form {
        margin-top: 15%;
        display: flex;
        bottom: 0;
        
    }
    .input {
         flex-grow:6;
    }
    .button {
        flex-grow:1;
    }



</style>


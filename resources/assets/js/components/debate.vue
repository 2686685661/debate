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

            }
        },
        methods: {

        },
        mounted() {
            
        }
    }
</script>

<style>
    /* .fix {
        display: flex;
    } */
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
        height: 3em;
        /* flex-grow:1; */
        margin-bottom: 2%;
    }
    .left, .right  {
        /* width: 30%; */
        text-align: center;
        flex-grow:2;
    }
    .pk_text {
        flex-grow:1;
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
        height: 10em;
        background: red;
    }
    .form {
        display: flex;
    }
    .input {
         flex-grow:6;
    }
    .button {
        flex-grow:1;
    }
    /* .right_color {
        background-color:!important;
    } */


</style>


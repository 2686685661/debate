<template>
    <div class="content">
        <div v-bind:style="{height:clientHeight + 'px'}" class="login-Bg-Img">
            <div class="hTop">
                <img src="../static/log.png" alt="三月Logo">
                <span>March</span>
            </div>
            <mt-field placeholder="账号" class="login-input"  v-model="student.userName"></mt-field>
            <mt-field placeholder="密码" type="password" class="login-input"  v-model="student.passWord"></mt-field>
            <div class="login-buttonBox">
                <mt-button type="primary" class="login-button" @click.native="doSubmit">登录</mt-button>
            </div>
        </div>
    </div>
</template>

<script>
    import { Toast,Indicator } from 'mint-ui';
    export default {
        data() {
            return {
                clientHeight: document.documentElement.clientHeight,
                student: {
                    userName: "",
                    passWord: ""
                }
            }
        },
        methods: {
            trimStr: function(str) {
                return str.replace(/\s+/g, "");
            },
            doSubmit: function(){
                var that = this;
                let user = that.trimStr(that.student.userName);
                let passW = that.trimStr(that.student.passWord);
                // console.log(passW,user)
                if (user == '') {
                    Toast('请填写您的账号');
                    return;
                }else if (passW== '') {
                    Toast('请输入密码！');
                    return;
                };
                axios.post('/login', {
                    idNum: user,
                    pwd: passW
                }).then(function (response) {
                    let date = response.data;
                    if (date.status==0) {
                        Toast('登录成功！');
                        // that.$router.push({ path: '/debate' });
                        window.location.href = '/welcome';
                    }else if(date.status == 1) {
                        Toast(date.msg);
                    }
                    else {
                        that.$router.push({ path: '/signin' });
                    }
                })
                .catch(function (error) {
                    console.log(error);
                });
            }
        },
        mounted() {
             Indicator.close();
        }
    }
</script>
<style>
    .login-input .mint-field-core {
        background-color: rgba(0,0,0,0);
        color: #fff;
    }
    .login-input .mint-field-core::-webkit-input-placeholder { 
        color: #fff;
    }
    .login-input .mint-field-core::-moz-input-placeholder { 
        color: #fff;
    }
    .login-input .mint-field-core::-ms-input-placeholder { 
        color: #fff;
    }
</style>
<style scoped>
    .login-buttonBox {
        margin: 0 20px 10px;
    }
    .login-button {
        width: 100%;
        border-radius: 20px;
        margin-top: 30px;
    }
    .hTop {
        display: flex;
        align-items: center;
        color: #fff;
        font-size: 20px;
        margin-bottom: 20px;
        padding: 29% 20px 10px;
    }
    .hTop>img {
        width:40px;
        margin-right: 10px;
    }
    .login-input {
        background-color: rgba(0,0,0,0);
    }
    .login-Bg-Img {
        background-image: url(../static/bg.jpg);
        background-size: cover;
    } 
</style>


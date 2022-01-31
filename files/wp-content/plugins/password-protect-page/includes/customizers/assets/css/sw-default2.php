body.ppwp-sitewide-protection {
background: #2a2c2e url("<?php echo ppw_get_background_image( 'sw-default2.jpg' ); ?>") no-repeat center/cover !important;
}

.pda-form-login {
width: 50%;
height: 100%;
position: relative;
left: 0;
margin: 0 0 0 auto;
padding: 0;
}

.pda-form-login form {
max-width: 350px;
top: 50%;
left: 50%;
transform: translate(-50%, -50%);
position: relative;
padding: 2rem;
overflow: hidden;
background: #111;
border-radius: 0.4em;
border: 1px solid #191919;
box-shadow: 1px 1px 78px #171717;
color: #fff;
}

.pda-form-login a.ppw-swp-logo {
top: 26%;
position: absolute;
left: 50%;
transform: translate(-50%, -50%);
}

.pda-form-login form:before {
content: "";
width: 8px;
height: 5px;
position: absolute;
left: 34%;
top: -7px;
border-radius: 50%;
box-shadow: 0 0 6px 4px #fff;
}

.pda-form-login form:after {
content: "";
width: 400px;
height: 200px;
position: absolute;
top: 0;
left: 35px;
transform: rotate(75deg);
background: linear-gradient(50deg, rgba(255, 255, 255, 0.15), transparent);
opacity: .4;
z-index: -1;
}

.pda-form-login .input_wp_protect_password {
padding: .8rem;
background: linear-gradient(#1f2124, #27292c);
border: 1px solid #000;
box-shadow: 0 1px 0 rgba(255, 255, 255, 0.1);
border-radius: 3px;
color: #fff;
padding-right: 2.5rem;
}

.pda-form-login .input_wp_protect_password:focus {
box-shadow: inset 0 0 2px #000;
background: #494d54;
outline: none;
}

.pda-form-login .button-login {
width: 100%;
border: 1px solid rgba(0, 0, 0, 0.4);
box-shadow: inset 0 1px 0 rgba(255, 255, 255, 0.3), inset 0 10px 10px rgba(255, 255, 255, 0.1);
border-radius: 3px;
background: #218dd6;
cursor: pointer;
font-weight: 700;
font-size: 15px;
text-shadow: 0 -1px 0 rgba(0, 0, 0, 0.8);
margin-top: 1rem;
}

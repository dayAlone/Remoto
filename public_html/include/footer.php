<?php
$APPLICATION->IncludeComponent("bitrix:menu", "menu",
array(
    "ALLOW_MULTI_SELECT" => "Y",
    "MENU_CACHE_TYPE"    => "A",
    "ROOT_MENU_TYPE"     => "top",
    "MAX_LEVEL"          => "1",
    "CLASS"              => "nav--modal",
    "AFTER"              => SITE_ID === 's1' ?
                            '<a href="#Request" data-toggle="modal" class="toolbar__button">Request a proposal</a>' :
                            '<div class="toolbar__socials visible-xs">
                                <a target="_blank" href="'.COption::GetOptionString("grain.customsettings", 'get_fb').'" class="toolbar__social">'.svg('social-fb').'</a>
                                <a target="_blank" href="'.COption::GetOptionString("grain.customsettings", 'get_inst').'" class="toolbar__social">'.svg('social-inst').'</a>
                                <a target="_blank" href="'.COption::GetOptionString("grain.customsettings", 'get_tw').'" class="toolbar__social">'.svg('social-tw').'</a>
                                <a target="_blank" href="'.COption::GetOptionString("grain.customsettings", 'get_gp').'" class="toolbar__social">'.svg('social-gp').'</a>
                            </div>'
),
false);
?>
<div id="Request" tabindex="-1" role="dialog" aria-hidden="true" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <a href="#" data-dismiss="modal" class="modal__close"><img src="/layout/images/svg/close.svg" alt=""></a>
            <h2 class="modal__title">request a proposal</h2>
            <div class='form__success hidden'>
                <h3>Thank you for your request. We will get back to you soon!</h3>
            </div>
            <div class='form__action'>
                <form data-parsley-validate class="form">
                    <input type="hidden" name="to" value='<?=$APPLICATION->GetPageProperty("to")?>'>
                    <div class="row">
                        <div class="col-xs-12">
                            <input type="text" placeholder="Your name *" name="name" required class="form__input">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12 col-sm-6">
                            <input type="text" placeholder="Company *" name="company" required class="form__input">
                        </div>
                        <div class="col-xs-12 col-sm-6">
                            <input type="text" placeholder="Website *" name="website" required class="form__input">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12 col-sm-6">
                            <input type="text" placeholder="Phone *" name="phone" required class="form__input">
                        </div>
                        <div class="col-xs-12 col-sm-6">
                            <input type="email" placeholder="E-mail *" name="email" required class="form__input">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12 col-sm-6">
                            <input type="text" placeholder="Customer base" name="customer" class="form__input">
                        </div>
                        <div class="col-xs-12 col-sm-6">
                            <input type="text" placeholder="Regions coverage" name="coverage" class="form__input">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12">
                            <input type="radio" name="type" value="4G/LTE" checked id="r-1" class="form__radio">
                            <label for="r-1" class="form__label">4G/LTE</label>
                            <input type="radio" name="type" value="3G only" id="r-2" class="form__radio">
                            <label for="r-2" class="form__label">3G only</label>
                        </div>
                    </div>
                    <div class="row form__footer">
                        <div class="col-xs-9 col-sm-3">
                            <div class="form__label">Enter this code</div>
                            <div class="form__captcha captcha"></div>
                        </div>
                        <div class="col-xs-3 col-sm-1 center"><a href="#" class="form__refresh"><svg width="66" height="66" viewBox="0 0 66 66" xmlns="http://www.w3.org/2000/svg"><path d="M30.802 2.863c0 1.105.896 2 2 2 7.48 0 14.51 2.912 19.8 8.2 5.288 5.29 8.2 12.322 8.2 19.8 0 7.38-2.842 14.324-8 19.587v-5.587c0-1.104-.895-2-2-2-1.104 0-2 .896-2 2v12h12c1.105 0 2-.895 2-2 0-1.104-.895-2-2-2h-4.776c5.66-5.968 8.776-13.742 8.776-22 0-8.547-3.328-16.583-9.373-22.627C49.383 4.19 41.35.863 32.8.863c-1.104 0-2 .896-2 2zM8.176 53.49c6.044 6.045 14.08 9.373 22.626 9.373 1.105 0 2-.895 2-2 0-1.104-.895-2-2-2-7.48 0-14.51-2.912-19.797-8.2-5.29-5.29-8.203-12.32-8.203-19.8 0-7.38 2.842-14.323 8-19.587v5.587c0 1.105.896 2 2 2 1.105 0 2-.895 2-2v-12h-12c-1.104 0-2 .896-2 2 0 1.105.896 2 2 2H8.58c-5.664 6.97-8.78 14.742-8.78 23 0 8.547 3.33 16.583 9.374 22.627z" id="refresh" fill="#0B4ACE" fill-rule="evenodd"/></svg></a></div>
                        <div class="col-xs-12 col-sm-3">
                            <div class="form__label">into this field</div>
                            <input type="hidden" name="captcha_code">
                            <input type="text" name="captcha_word" required class="form__input">
                        </div>
                        <div class="col-xs-12 col-sm-5 right">
                            <button class="form__button">send</button>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12">* Required field</div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<div id="Feedback" tabindex="-1" role="dialog" aria-hidden="true" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content"><a href="#" data-dismiss="modal" class="modal__close"><img src="/layout/images/svg/close.svg" alt=""></a>
            <h2 class="modal__title">Feedback</h2>
            <div class='form__success hidden'>
                <h3>Thank you for your request. We will get back to you soon!</h3>
            </div>
            <div class='form__action'>
                <form data-parsley-validate class="form">
                    <input type="hidden" name="to" value='feedback'>
                    <div class="row">
                        <div class="col-xs-12 col-sm-6">
                            <input type="text" placeholder="Your name *" name="name" required class="form__input">
                        </div>
                        <div class="col-xs-12 col-sm-6">
                            <input type="email" placeholder="E-mail *" name="email" required class="form__input">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12 col-sm-6">
                            <input type="text" placeholder="Phone" name="phone" class="form__input">
                        </div>
                        <div class="col-xs-12 col-sm-6">
                            <select name="qtype" required class="form__select">
                                <option value="">Question type *</option>
                                <option value="Product">Product</option>
                                <option value="Partnership">Partnership</option>
                                <option value="Marketing and Press">Marketing and Press</option>
                            </select><img src="/layout/images/svg/arrow.svg" alt="">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12">
                            <textarea placeholder="Message *" name="message" class="form__textarea"></textarea>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-9 col-sm-3">
                            <div class="form__label">Enter this code</div>
                            <div class="form__captcha captcha"></div>
                        </div>
                        <div class="col-xs-3 col-sm-1 center"><a href="#" class="form__refresh"><svg width="66" height="66" viewBox="0 0 66 66" xmlns="http://www.w3.org/2000/svg"><path d="M30.802 2.863c0 1.105.896 2 2 2 7.48 0 14.51 2.912 19.8 8.2 5.288 5.29 8.2 12.322 8.2 19.8 0 7.38-2.842 14.324-8 19.587v-5.587c0-1.104-.895-2-2-2-1.104 0-2 .896-2 2v12h12c1.105 0 2-.895 2-2 0-1.104-.895-2-2-2h-4.776c5.66-5.968 8.776-13.742 8.776-22 0-8.547-3.328-16.583-9.373-22.627C49.383 4.19 41.35.863 32.8.863c-1.104 0-2 .896-2 2zM8.176 53.49c6.044 6.045 14.08 9.373 22.626 9.373 1.105 0 2-.895 2-2 0-1.104-.895-2-2-2-7.48 0-14.51-2.912-19.797-8.2-5.29-5.29-8.203-12.32-8.203-19.8 0-7.38 2.842-14.323 8-19.587v5.587c0 1.105.896 2 2 2 1.105 0 2-.895 2-2v-12h-12c-1.104 0-2 .896-2 2 0 1.105.896 2 2 2H8.58c-5.664 6.97-8.78 14.742-8.78 23 0 8.547 3.33 16.583 9.374 22.627z" id="refresh" fill="#0B4ACE" fill-rule="evenodd"/></svg></a></div>
                        <div class="col-xs-12 col-sm-3">
                            <div class="form__label">into this field</div>
                            <input type="hidden" name="captcha_code">
                            <input type="text" name="captcha_word" required class="form__input">
                        </div>
                        <div class="col-xs-12 col-sm-5 right">
                            <button class="form__button">send</button>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12">* Required field</div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<div id="Detail" tabindex="-1" role="dialog" aria-hidden="true" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <a href="#" data-dismiss="modal" class="modal__close"><img src="/layout/images/svg/close.svg" alt=""></a>
            <div class='text'>

            </div>

        </div>
    </div>
</div>

<div id="Infractructure" tabindex="-1" role="dialog" aria-hidden="true" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <a href="#" data-dismiss="modal" class="modal__close"><img src="/layout/images/svg/close.svg" alt=""></a>
            <h2 class="modal__title">Infrastructure OF REMOTO WIFI</h2>
                <img src="/layout/images/infractructure.jpg" alt="" />
            </div>
        </div>
    </div>
</div>

<?/*
<div id="How" tabindex="-1" role="dialog" aria-hidden="true" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <a href="#" data-dismiss="modal" class="modal__close"><img src="/layout/images/svg/close.svg" alt=""></a>
            <h2 class="modal__title">How does it work</h2>
                <img src="/layout/images/how.jpg" alt="" />
            </div>
        </div>
    </div>
</div>
*?>

<!-- Yandex.Metrika counter --> <script type="text/javascript"> (function (d, w, c) { (w[c] = w[c] || []).push(function() { try { w.yaCounter37828150 = new Ya.Metrika({ id:37828150, clickmap:true, trackLinks:true, accurateTrackBounce:true, webvisor:true }); } catch(e) { } }); var n = d.getElementsByTagName("script")[0], s = d.createElement("script"), f = function () { n.parentNode.insertBefore(s, n); }; s.type = "text/javascript"; s.async = true; s.src = "https://mc.yandex.ru/metrika/watch.js"; if (w.opera == "[object Opera]") { d.addEventListener("DOMContentLoaded", f, false); } else { f(); } })(document, window, "yandex_metrika_callbacks"); </script> <noscript><div><img src="https://mc.yandex.ru/watch/37828150" style="position:absolute; left:-9999px;" alt="" /></div></noscript> <!-- /Yandex.Metrika counter -->
<script>
(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
})(window,document,'script','https://www.google-analytics.com/analytics.js','ga');
ga('create', 'UA-78966838-1', 'auto');
ga('send', 'pageview');
</script>
</body>



</html>

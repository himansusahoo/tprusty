
<!DOCTYPE html>
<html lang="en" style="min-height:100%;">
    <head>
        <meta charset="utf-8">
        <link href="http://localhost:81/ioncbe/twitterbootstrap/img/favicon.ico" rel="shortcut icon" type="image/x-icon" />
        <title>IonCBE</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="">
        <meta name="author" content="">
        <script>
            var base_url = 'http://localhost:81/ioncbe/';
        </script>

        <script src="http://localhost:81/ioncbe/node_modules/jquery/dist/jquery.min.js"></script>        
        <link rel="stylesheet" href="http://localhost:81/ioncbe/vendor/twitter/bootstrap/docs/assets/css/bootstrap.css" />
        <link rel="stylesheet" href="http://localhost:81/ioncbe/vendor/twitter/bootstrap/docs/assets/css/bootstrap-responsive.css" />
        <link rel="stylesheet" href="http://localhost:81/ioncbe/vendor/twitter/bootstrap/docs/assets/css/docs.css" />
        <link rel="stylesheet" href="http://localhost:81/ioncbe/assets/css/custom.css" />                <link rel="stylesheet" href="http://localhost:81/ion_cbe/application/modules/app_layout/assets/css/lib/jquery.noty.css">
        <link rel="stylesheet" href="http://localhost:81/ion_cbe/application/modules/app_layout/assets/css/lib/prettify.css">
        <link rel="stylesheet" href="http://localhost:81/ion_cbe/application/modules/app_layout/assets/css/lib/noty_theme_default.css">
        <link rel="stylesheet" href="http://localhost:81/ion_cbe/application/modules/app_layout/assets/css/lib/bootstrap-datepicker.min.css">

        <script type="text/javascript">
            //dont reposition the code, this will use all custome js files.
            $(document).ready(function () {
                window.base_url = 'http://localhost:81/ioncbe/';
            });
        </script>

    </head>
    <body data-target=".bs-docs-sidebar" onload="noBack();" style="min-height:100%; padding: 0px;" onpageshow="if (event.persisted) noBack();">
        <section class="content-header header-section">

            <header class="jumbotron subhead" id="overview" style="background: rgb(35, 47, 62); padding-top:2px; padding-bottom:2px; ">
                <div class="container-fluid">
                    <img src="http://localhost:81/ioncbe/assets/images/ioncbe_logo.png" style="width: 200px; -webkit-border-radius: 12px; float:left; background-color: white; margin-top: 1px;">
                    <img src="http://localhost:81/ioncbe/assets/images/your_logo.png" class="img-circle" style="float:right;"/>
                    <center>
                        <b id="org_name" style="text-shadow: 2px 2px black; color: white; font-size: 15px; margin-top: 10px;">  (T2)</b> <br>
                    </center>
                </div>
            </header>
        </section>
        <section class="content content-section">
            <!--<div class="wrapper parallax marquee_data"></div>-->
            <div class="container-fluid" style="padding-right: 0px;">
                <div class="row-fluid">
                    <!--head here -->
                    <div class="">
                        <div class="content-section-content">
                            <div style="padding-right: 20px;">
                                <div class="row-fluid">
                                    <div class="span8" style="margin-left:50px; margin-bottom:78px; height:320px;">
                                        <img class="img-rounded" id="myImage" src="http://localhost:81/ion_cbe/twitterbootstrap/img/IonCUDOS-TagCloud.png" height="1000" width="800" />
                                    </div>

                                    <div class="span3" style="min-height:320px; margin-top: 40px;"><br>
                                        <form method="POST" action="http://localhost:81/ion_cbe/login" class="form-signin">
                                            <div class="navbar">
                                                <div class="navbar-inner-custom key-data" data-key="lg_sgn_in">
                                                    Sign in
                                                </div>
                                            </div>

                                            <label><span class="key-data" data-key="lg_clg">Preference</span></label><select name="college" id="college" type="text" class="input-block-level required" required="1">
                                                <option value="" selected="selected">Select College</option>
                                                <option value="1">Sri Ramachandra Medical College & Research Institute</option>
                                                <option value="2">Rajiv Gandhi University of Health Sciences</option>
                                            </select>
                                            <label><span class="key-data" data-key="lg_usrnme">Username</span></label><input type="text" name="identity" value="" id="identity" class="input-block-level required" autofocus="autofocus"  />
                                            <label><span class="key-data" data-key="lg_pwd">Password</span></label><input type="password" name="password" value="" id="password" class="input-block-level required"  />

                                            <button class="btn btn-primary" type="submit"><i class="icon-lock icon-white"></i> <span class="key-data" data-key="lg_sgn_in">Sign in</span></button>

                                            <a class="pull-right key-data" href = "http://localhost:81/ion_cbe/login/forgot_password" style="text-decoration:underline; color:blue; font-size:12px;" data-key="lg_frgt_pwd">Forgot Password</a>
                                            <br />

                                            <!--Contact Support link-->
                                            <a href="" onclick="generate_modal();" class="pull-right key-data" rel="tooltip" data-toggle="modal" style="text-decoration:underline; color:blue; font-size:12px;" data-key="lg_cntct_suprt">Contact Support </a>
                                            <br>
                                        </form>
                                    </div><br>

                                    <div class="span11 media bs-docs-example" id="org_desc" style="background:none;margin-left: 50px; margin-top: 10px; font-family: arial; font-size: 12px;">
                                        <p>Sri Ramachandra Institute of Higher Education and Research (Deemed to be University), ranked among the top health sciences universities in India, had its origin as Sri Ramachandra Institute of Higher Education and Research which was established by Sri Ramachandra Educational and Health Trust in the year 1985 as a private not-for-profit self-financing institution and dedicated to serve the society as a centre of excellence with emphasis on medical education, research and health care. The Trust achieved the task of establishing the Institution as a &ldquo;Centre of Excellence&rdquo; under the leadership of Late Shri. N.P.V.Ramasamy Udayar who was the Founder &amp; Managing Trustee of the Trust and also the first Chancellor of the Deemed to be University. Shri. V.R. Venkataachalam is currently the Chancellor of the Deemed to be University and is also the Managing Trustee of the Trust.</p>
                                        <p>In view of its academic excellence, the Government of India declared Sri Ramachandra Institute of Higher Education and Research as a Deemed to be University in September, 1994 under Section 3 of the University Grants Commission Act, 1956.</p>
                                        <p>As required by the UGC, a separate and dedicated Trust, &ldquo;Sri Ramachandra University Trust&rdquo; was created in 2012 to run the Deemed to be University, fully complying with the UGC norms.</p>
                                        <p>Over three decades, the institute has transformed into a full-fledged Deemed to be University with nine Constituent Colleges / Faculties &ndash; Sri Ramachandra Institute of Higher Education and Research and Colleges of Dentistry, Pharmacy, Nursing, Physiotherapy, Allied Health Sciences, Management, Biomedical Sciences, Technology &amp; Research and Public Health offering 104 U.G. and P.G. courses in health care sciences, with a faculty strength of 836, with 6501 students receiving teaching-learning training under them,(Faculty: Student ratio 1:8) during the academic year 2017-18.</p>
                                        <p>The consistent quest for excellence in medical education, health care and research has earned the University many notable accreditations, recognitions and awards. Notable among them are -</p>
                                        <p>The National Assessment and Accreditation Council has reaccredited (cycle-2) Sri Ramachandra Institute of Higher Education and Research (Deemed to be University) with &ldquo;A&rdquo; Grade with a CGPA of 3.62 on a 4-point scale, the highest to be awarded to a private medical University in India.</p>
                                        <p>The Joint Commissio</p></div>

                                    <!--Contact Support Modal -->
                                    <div id="myModal" class="modal fade" style="display:none;" tabindex="-1" role="dialog" aria-hidden="true">
                                        <div class="modal-header">
                                            <div class="navbar-inner-custom key-data" data-key="lg_cntct_suprt">
                                                Contact Support
                                            </div>
                                        </div>

                                        <form id="loginForm" method="post" class="form-horizontal" onsubmit="return false;">
                                            <div class="modal-body">
                                                <table class="table table-bordered">
                                                    <tr>
                                                        <td> <span class="key-data" data-key="lg_subjct">Subject</span>:</td>
                                                        <td><input type="text" id="modal_subject" name="modal_subject" class="required"></td>
                                                    </tr>

                                                    <tr>
                                                        <td class="key-data" data-key="lg_your_mob_num">Your Mobile No</td><td><input type="text" id="modal_number" name="modal_number" class="required"></td>
                                                    </tr>

                                                    <tr>
                                                        <td class="key-data" data-key="lg_email_id">Email Id</td><td><input type="email" id="modal_mail" name="modal_mail" class="required"></td>
                                                    </tr>
                                                    <tr>
                                                        <td><span class="key-data" data-key="lg_body">Body</span>:</td>
                                                        <td>
                                                            <textarea rows="6" cols="80" maxlength="2000" style="width:90%;" placeholder="Enter your issues and details" data-key="lg_entr_issues_dtls" id="modal_body" name="modal_body" class="required char-counter key-data"></textarea>
                                                            <br />
                                                            <span id='char_span_support' class='margin-left5'>0 <span class="key-data" data-key="lg_of">of</span> 2000. </span>
                                                        </td>
                                                    </tr>
                                                </table>
                                            </div>

                                            <div class="modal-footer">
                                                <button class="btn btn-primary" id="modal_contact"><i class=  "icon-file icon-white"></i> <span class="key-data" data-key="lg_send">Send</span></button>
                                                <button type="reset" class="cancel btn btn-danger" data-dismiss="modal"><i class="icon-remove icon-white"></i> <span class="key-data" data-key="lg_close">Close</span></button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>	
                </div>
            </div>
        </section>
        <section class="content-footer footer-section">
            <footer class="footer-color footer_settings">
                <div class="footer-p">
                    <div class="span5"></div>
                    <div class="span5" style="margin-top:4px;">
                        IonCUDOS v6.2 - Copyright &copy; 2014 by IonIdea.
                    </div>
                    <div class="dropup span2" style="margin-top:4px;">
                    </div>
                    <a style="color: white; text-decoration:none; position: relative; top: 4px;" 
                       class="span1" target="_blank" href="http://www.ioncudos.com/?page_id=237&msg_id=1&msg="> Feedback </a>
                </div>

            </footer>
            <script>
                var language_data = 0;
                var session_value = 'en';
            </script>
            <script type="text/javascript">window.base_url = 'http://localhost:81/ioncbe/';</script>

        </section>

        <script src="http://localhost:81/ioncbe/vendor/twitter/bootstrap/docs/assets/js/bootstrap.min.js" ></script>
        <script src="http://localhost:81/ioncbe/node_modules/jquery-slimscroll/jquery.slimscroll.min.js" ></script>
        <script src="http://localhost:81/ioncbe/assets/js/App.js" ></script>
        <script src="http://localhost:81/ioncbe/assets/js/generic.js" ></script>
        <script src="http://localhost:81/ioncbe/assets/js/locale_lang.js" ></script>
        <script src="http://localhost:81/ioncbe/assets/js/messages.js" ></script>                        <script>
    var configs = {};
    $(".content-section").css('height', myApp.CommonMethod.getContainerHeight(configs));

    var configs = {adjustment: 0};
    $(".content-section-content").css('height', myApp.CommonMethod.getContainerHeight(configs));

    $('.content-section-content').slimscroll({
        height: myApp.CommonMethod.getContainerHeight(configs),
        width: '100%',
        color: 'red',
        size: '5px',
        railBorderRadius: 10
    });
        </script>
    </body>
</html>
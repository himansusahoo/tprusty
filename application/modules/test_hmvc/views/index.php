<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>Welcome to CodeIgniter - HMVC</title>

        <style type="text/css">

            ::selection { background-color: #E13300; color: white; }
            ::-moz-selection { background-color: #E13300; color: white; }

            body {
                background-color: #fff;
                margin: 40px;
                font: 13px/20px normal Helvetica, Arial, sans-serif;
                color: #4F5155;
            }

            a {
                color: #003399;
                background-color: transparent;
                font-weight: normal;
            }

            h1 {
                color: #444;
                background-color: transparent;
                border-bottom: 1px solid #D0D0D0;
                font-size: 19px;
                font-weight: normal;
                margin: 0 0 14px 0;
                padding: 14px 15px 10px 15px;
            }

            code {
                font-family: Consolas, Monaco, Courier New, Courier, monospace;
                font-size: 12px;
                background-color: #f9f9f9;
                border: 1px solid #D0D0D0;
                color: #002166;
                display: block;
                margin: 14px 0 14px 0;
                padding: 12px 10px 12px 10px;
            }

            #body {
                margin: 0 15px 0 15px;
            }

            p.footer {
                text-align: right;
                font-size: 11px;
                border-top: 1px solid #D0D0D0;
                line-height: 32px;
                padding: 0 10px 0 10px;
                margin: 20px 0 0 0;
            }

            #container {
                margin: 10px;
                border: 1px solid #D0D0D0;
                box-shadow: 0 0 8px #D0D0D0;
            }
        </style>
    </head>
    <body>

        <div id="container">
            <h1>Welcome to CodeIgniter - HMVC</h1>

            <div id="body">
                <?php
                echo '<br>' . "<a href='test_hmvc/test_encrypt' target='_blank'> Test Encrypt</a>";
                echo '<br>' . "<a href='test_hmvc/test_log' target='_blank'> Test Log</a>";
                echo '<br>' . "<a href='test_hmvc/scan_dir' target='_blank'> Scan DIR</a>";
                echo '<br>' . "<a href='test_hmvc/scan_dir/true' target='_blank'> Recursive Scan DIR</a>";
                echo '<br>' . "<a href='test_hmvc/scan_dir/true/html' target='_blank'> Filter Scan DIR</a>";
                echo '<br>' . "<a href='test_hmvc/create_file' target='_blank'> Test Create File</a>";
                
                echo '<br>' . "<a href='test_hmvc/blank_layout' target='_blank'> Blank Layout Test</a>";
                echo '<br>' . "<a href='".base_url('admin-login')."' target='_blank'> Login Test</a>";
                echo '<br>' . "<a href='test_hmvc/page_layout' target='_blank'> Page Layout Test</a>";
                echo '<br>' . "<a href='test_hmvc/chosen' target='_blank'> Chosen dropdown</a>";
                ?>
            </div>
        </div>

    </body>
</html>
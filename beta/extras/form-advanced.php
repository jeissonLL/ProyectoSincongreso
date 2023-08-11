<?php require 'includes/header_start.php'; ?>
<!-- Plugins css-->
<link href="../plugins/bootstrap-tagsinput/dist/bootstrap-tagsinput.css" rel="stylesheet" />
<link href="../plugins/multiselect/css/multi-select.css"  rel="stylesheet" type="text/css" />
<link href="../plugins/select2/select2.css" rel="stylesheet" type="text/css" />
<link href="../plugins/bootstrap-touchspin/dist/jquery.bootstrap-touchspin.min.css" rel="stylesheet" />

<link href="../plugins/timepicker/bootstrap-timepicker.min.css" rel="stylesheet">
<link href="../plugins/mjolnic-bootstrap-colorpicker/dist/css/bootstrap-colorpicker.min.css" rel="stylesheet">
<link href="../plugins/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css" rel="stylesheet">
<link href="../plugins/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet">

<?php require 'includes/header_end.php'; ?>

<!-- Page-Title -->
<div class="row">
    <div class="col-sm-12">
        <div class="page-title-box">
            <ol class="breadcrumb pull-right">
                <li><a href="#">Minton</a></li>
                <li><a href="#">Forms</a></li>
                <li class="active">Advanced Plugins</li>
            </ol>
            <h4 class="page-title">Advanced Plugins</h4>
        </div>
    </div>
</div>



<div class="row">
    <div class="col-sm-12">
        <div class="card-box">
            <h4 class="m-t-0 m-b-20 header-title"><b>Tags Input</b></h4>

            <div class="row">
                <div class="col-md-6">
                    <h5><b>Input Tags</b></h5>
                    <p class="text-muted m-b-30 font-13">
                        Just add <code>data-role="tagsinput"</code> to your input field to automatically change it to a tags input field.
                    </p>
                    <div class="tags-default">
                        <input type="text" value="Amsterdam,Washington,Sydney" data-role="tagsinput" placeholder="add tags"/>
                    </div>

                </div>

                <div class="col-md-6">
                    <h5><b>True multi value</b></h5>
                    <p class="text-muted m-b-30 font-13">
                        Use a <code>&lt;select multiple /&gt;</code> as your input element for a tags input, to gain true multivalue support.
                        Instead of a comma separated string, the values will be set in an array. Existing <code>&lt;option /&gt;</code>
                        elements will automatically be set as tags. This makes it also possible to create tags containing a comma.
                    </p>
                    <div class="m-b-0">
                        <select multiple data-role="tagsinput">
                            <option value="Amsterdam">Amsterdam</option>
                            <option value="Washington">Washington</option>
                            <option value="Sydney">Sydney</option>
                        </select>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>


<!-- Switchery -->
<div class="row">
    <div class="col-sm-12">
        <div class="card-box">
            <h4 class="m-t-0 m-b-20 header-title"><b>Switchery</b></h4>
            <div class="row">
                <div class="col-lg-4">
                    <h5><b>Basic</b></h5>
                    <p class="text-muted m-b-30 font-13">
                        Add an attribute <code>
                            data-plugin="switchery" data-color="@colors"</code>
                        to your input element and it will be converted into switch.
                    </p>

                    <div class="switchery-demo">
                        <input type="checkbox" checked data-plugin="switchery" data-color="#00b19d"/>
                        <input type="checkbox" checked data-plugin="switchery" data-color="#ffaa00"/>
                        <input type="checkbox" checked data-plugin="switchery" data-color="#3bafda"/>
                        <input type="checkbox" checked data-plugin="switchery" data-color="#3DDCF7"/>
                        <input type="checkbox" checked data-plugin="switchery" data-color="#7266ba"/>
                        <input type="checkbox" checked data-plugin="switchery" data-color="#f76397"/>
                        <input type="checkbox" checked data-plugin="switchery" data-color="#4c5667"/>
                        <input type="checkbox" checked data-plugin="switchery" data-color="#98a6ad"/>
                        <input type="checkbox" checked data-plugin="switchery" data-color="#ef5350"/>
                    </div>

                </div>

                <div class="col-lg-4">
                    <h5><b>Sizes</b></h5>
                    <p class="text-muted m-b-30 font-13">
                        Add an attribute <code>
                            data-size="small",data-size="large"</code>
                        to your input element and it will be converted into switch.
                    </p>

                    <div class="">
                        <input type="checkbox" checked data-plugin="switchery" data-color="#00b19d" data-size="small"/>
                        <input type="checkbox" checked data-plugin="switchery" data-color="#3DDCF7"/>
                        <input type="checkbox" checked data-plugin="switchery" data-color="#4c5667" data-size="large"/>
                    </div>

                </div>

                <div class="col-lg-4">
                    <h5><b>Secondary color</b></h5>
                    <p class="text-muted m-b-30 font-13">
                        Add an attribute <code>
                            data-color="@color" data-secondary-color="@color"</code>
                        to your input element and it will be converted into switch.
                    </p>

                    <div class="">
                        <input type="checkbox" data-plugin="switchery" data-color="#1AB394" data-secondary-color="#ED5565" />
                        <input type="checkbox" data-plugin="switchery" data-color="#fb6d9d"  data-secondary-color="#7266ba" />
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>


<div class="row">
    <div class="col-lg-6">
        <div class="card-box">
            <h4 class="m-t-0 m-b-30 header-title"><b>Multiple Select</b></h4>
            <h5><b>Default</b></h5>
            <p class="text-muted m-b-15 font-13">
                Use a <code>
                    &lt;select multiple /&gt;</code>
                as your input element for a tags input, to gain true multivalue support.
            </p>

            <select multiple="multiple" class="multi-select" id="my_multi_select1" name="my_multi_select1[]" data-plugin="multiselect">
                <option>Dallas Cowboys</option>
                <option>New York Giants</option>
                <option selected>Philadelphia Eagles</option>
                <option selected>Washington Redskins</option>
                <option>Chicago Bears</option>
                <option>Detroit Lions</option>
                <option>Green Bay Packers</option>
                <option>Minnesota Vikings</option>
                <option selected>Atlanta Falcons</option>
                <option>Carolina Panthers</option>
                <option>New Orleans Saints</option>
                <option>Tampa Bay Buccaneers</option>
                <option>Arizona Cardinals</option>
                <option>St. Louis Rams</option>
                <option>San Francisco 49ers</option>
                <option>Seattle Seahawks</option>
            </select>


            <h5 class="m-t-30"><b>Grouped Options</b></h5>
            <p class="text-muted m-b-15 font-13">
                Use a <code>
                    &lt;select multiple /&gt;</code>
                as your input element for a tags input, to gain true multivalue support.
            </p>

            <select multiple="multiple" class="multi-select" id="my_multi_select2" name="my_multi_select2[]" data-plugin="multiselect" data-selectable-optgroup="true">
                <optgroup label="NFC EAST">
                    <option>Dallas Cowboys</option>
                    <option>New York Giants</option>
                    <option>Philadelphia Eagles</option>
                    <option>Washington Redskins</option>
                </optgroup>
                <optgroup label="NFC NORTH">
                    <option>Chicago Bears</option>
                    <option>Detroit Lions</option>
                    <option>Green Bay Packers</option>
                    <option>Minnesota Vikings</option>
                </optgroup>
                <optgroup label="NFC SOUTH">
                    <option>Atlanta Falcons</option>
                    <option>Carolina Panthers</option>
                    <option>New Orleans Saints</option>
                    <option>Tampa Bay Buccaneers</option>
                </optgroup>
                <optgroup label="NFC WEST">
                    <option>Arizona Cardinals</option>
                    <option>St. Louis Rams</option>
                    <option>San Francisco 49ers</option>
                    <option>Seattle Seahawks</option>
                </optgroup>
            </select>


            <h5 class="m-t-30"><b>Searchable</b></h5>
            <p class="text-muted m-b-15 font-13">
                Use a <code>
                    &lt;select multiple /&gt;</code>
                as your input element for a tags input, to gain true multivalue support.
            </p>

            <select name="country" class="multi-select" multiple="" id="my_multi_select3" >
                <option value="AF">Afghanistan</option>
                <option value="AL">Albania</option>
                <option value="DZ">Algeria</option>
                <option value="AS">American Samoa</option>
                <option value="AD">Andorra</option>
                <option value="AO">Angola</option>
                <option value="AI">Anguilla</option>
                <option value="AQ">Antarctica</option>
                <option value="AR">Argentina</option>
                <option value="AM">Armenia</option>
                <option value="AW">Aruba</option>
                <option value="AU">Australia</option>
                <option value="AT">Austria</option>
                <option value="AZ">Azerbaijan</option>
                <option value="BS">Bahamas</option>
                <option value="BH">Bahrain</option>
                <option value="BD">Bangladesh</option>
                <option value="BB">Barbados</option>
                <option value="BY">Belarus</option>
                <option value="BE">Belgium</option>
                <option value="BZ">Belize</option>
                <option value="BJ">Benin</option>
                <option value="BM">Bermuda</option>
                <option value="BT">Bhutan</option>
                <option value="BO">Bolivia</option>
                <option value="BA">Bosnia and Herzegowina</option>
                <option value="BW">Botswana</option>
                <option value="BV">Bouvet Island</option>
                <option value="BR">Brazil</option>
                <option value="IO">British Indian Ocean Territory</option>
                <option value="BN">Brunei Darussalam</option>
                <option value="BG">Bulgaria</option>
                <option value="BF">Burkina Faso</option>
                <option value="BI">Burundi</option>
                <option value="KH">Cambodia</option>
                <option value="CM">Cameroon</option>
                <option value="CA">Canada</option>
                <option value="CV">Cape Verde</option>
                <option value="KY">Cayman Islands</option>
                <option value="CF">Central African Republic</option>
                <option value="TD">Chad</option>
                <option value="CL">Chile</option>
                <option value="CN">China</option>
                <option value="CX">Christmas Island</option>
                <option value="CC">Cocos (Keeling) Islands</option>
                <option value="CO">Colombia</option>
                <option value="KM">Comoros</option>
                <option value="CG">Congo</option>
                <option value="CD">Congo, the Democratic Republic of the</option>
                <option value="CK">Cook Islands</option>
                <option value="CR">Costa Rica</option>
                <option value="CI">Cote d'Ivoire</option>
                <option value="HR">Croatia (Hrvatska)</option>
                <option value="CU">Cuba</option>
                <option value="CY">Cyprus</option>
                <option value="CZ">Czech Republic</option>
                <option value="DK">Denmark</option>
                <option value="DJ">Djibouti</option>
                <option value="DM">Dominica</option>
                <option value="DO">Dominican Republic</option>
                <option value="EC">Ecuador</option>
                <option value="EG">Egypt</option>
                <option value="SV">El Salvador</option>
                <option value="GQ">Equatorial Guinea</option>
                <option value="ER">Eritrea</option>
                <option value="EE">Estonia</option>
                <option value="ET">Ethiopia</option>
                <option value="FK">Falkland Islands (Malvinas)</option>
                <option value="FO">Faroe Islands</option>
                <option value="FJ">Fiji</option>
                <option value="FI">Finland</option>
                <option value="FR">France</option>
                <option value="GF">French Guiana</option>
                <option value="PF">French Polynesia</option>
                <option value="TF">French Southern Territories</option>
                <option value="GA">Gabon</option>
                <option value="GM">Gambia</option>
                <option value="GE">Georgia</option>
                <option value="DE">Germany</option>
                <option value="GH">Ghana</option>
                <option value="GI">Gibraltar</option>
                <option value="GR">Greece</option>
                <option value="GL">Greenland</option>
                <option value="GD">Grenada</option>
                <option value="GP">Guadeloupe</option>
                <option value="GU">Guam</option>
                <option value="GT">Guatemala</option>
                <option value="GN">Guinea</option>
                <option value="GW">Guinea-Bissau</option>
                <option value="GY">Guyana</option>
                <option value="HT">Haiti</option>
                <option value="HM">Heard and Mc Donald Islands</option>
                <option value="VA">Holy See (Vatican City State)</option>
                <option value="HN">Honduras</option>
                <option value="HK">Hong Kong</option>
                <option value="HU">Hungary</option>
                <option value="IS">Iceland</option>
                <option value="IN">India</option>
                <option value="ID">Indonesia</option>
                <option value="IR">Iran (Islamic Republic of)</option>
                <option value="IQ">Iraq</option>
                <option value="IE">Ireland</option>
                <option value="IL">Israel</option>
                <option value="IT">Italy</option>
                <option value="JM">Jamaica</option>
                <option value="JP">Japan</option>
                <option value="JO">Jordan</option>
                <option value="KZ">Kazakhstan</option>
                <option value="KE">Kenya</option>
                <option value="KI">Kiribati</option>
                <option value="KP">Korea, Democratic People's Republic of</option>
                <option value="KR">Korea, Republic of</option>
                <option value="KW">Kuwait</option>
                <option value="KG">Kyrgyzstan</option>
                <option value="LA">Lao People's Democratic Republic</option>
                <option value="LV">Latvia</option>
                <option value="LB">Lebanon</option>
                <option value="LS">Lesotho</option>
                <option value="LR">Liberia</option>
                <option value="LY">Libyan Arab Jamahiriya</option>
                <option value="LI">Liechtenstein</option>
                <option value="LT">Lithuania</option>
                <option value="LU">Luxembourg</option>
                <option value="MO">Macau</option>
                <option value="MK">Macedonia, The Former Yugoslav Republic of</option>
                <option value="MG">Madagascar</option>
                <option value="MW">Malawi</option>
                <option value="MY">Malaysia</option>
                <option value="MV">Maldives</option>
                <option value="ML">Mali</option>
                <option value="MT">Malta</option>
                <option value="MH">Marshall Islands</option>
                <option value="MQ">Martinique</option>
                <option value="MR">Mauritania</option>
                <option value="MU">Mauritius</option>
                <option value="YT">Mayotte</option>
                <option value="MX">Mexico</option>
                <option value="FM">Micronesia, Federated States of</option>
                <option value="MD">Moldova, Republic of</option>
                <option value="MC">Monaco</option>
                <option value="MN">Mongolia</option>
                <option value="MS">Montserrat</option>
                <option value="MA">Morocco</option>
                <option value="MZ">Mozambique</option>
                <option value="MM">Myanmar</option>
                <option value="NA">Namibia</option>
                <option value="NR">Nauru</option>
                <option value="NP">Nepal</option>
                <option value="NL">Netherlands</option>
                <option value="AN">Netherlands Antilles</option>
                <option value="NC">New Caledonia</option>
                <option value="NZ">New Zealand</option>
                <option value="NI">Nicaragua</option>
                <option value="NE">Niger</option>
                <option value="NG">Nigeria</option>
                <option value="NU">Niue</option>
                <option value="NF">Norfolk Island</option>
                <option value="MP">Northern Mariana Islands</option>
                <option value="NO">Norway</option>
                <option value="OM">Oman</option>
                <option value="PK">Pakistan</option>
                <option value="PW">Palau</option>
                <option value="PA">Panama</option>
                <option value="PG">Papua New Guinea</option>
                <option value="PY">Paraguay</option>
                <option value="PE">Peru</option>
                <option value="PH">Philippines</option>
                <option value="PN">Pitcairn</option>
                <option value="PL">Poland</option>
                <option value="PT">Portugal</option>
                <option value="PR">Puerto Rico</option>
                <option value="QA">Qatar</option>
                <option value="RE">Reunion</option>
                <option value="RO">Romania</option>
                <option value="RU">Russian Federation</option>
                <option value="RW">Rwanda</option>
                <option value="KN">Saint Kitts and Nevis</option>
                <option value="LC">Saint LUCIA</option>
                <option value="VC">Saint Vincent and the Grenadines</option>
                <option value="WS">Samoa</option>
                <option value="SM">San Marino</option>
                <option value="ST">Sao Tome and Principe</option>
                <option value="SA">Saudi Arabia</option>
                <option value="SN">Senegal</option>
                <option value="SC">Seychelles</option>
                <option value="SL">Sierra Leone</option>
                <option value="SG">Singapore</option>
                <option value="SK">Slovakia (Slovak Republic)</option>
                <option value="SI">Slovenia</option>
                <option value="SB">Solomon Islands</option>
                <option value="SO">Somalia</option>
                <option value="ZA">South Africa</option>
                <option value="GS">South Georgia and the South Sandwich Islands</option>
                <option value="ES">Spain</option>
                <option value="LK">Sri Lanka</option>
                <option value="SH">St. Helena</option>
                <option value="PM">St. Pierre and Miquelon</option>
                <option value="SD">Sudan</option>
                <option value="SR">Suriname</option>
                <option value="SJ">Svalbard and Jan Mayen Islands</option>
                <option value="SZ">Swaziland</option>
                <option value="SE">Sweden</option>
                <option value="CH">Switzerland</option>
                <option value="SY">Syrian Arab Republic</option>
                <option value="TW">Taiwan, Province of China</option>
                <option value="TJ">Tajikistan</option>
                <option value="TZ">Tanzania, United Republic of</option>
                <option value="TH">Thailand</option>
                <option value="TG">Togo</option>
                <option value="TK">Tokelau</option>
                <option value="TO">Tonga</option>
                <option value="TT">Trinidad and Tobago</option>
                <option value="TN">Tunisia</option>
                <option value="TR">Turkey</option>
                <option value="TM">Turkmenistan</option>
                <option value="TC">Turks and Caicos Islands</option>
                <option value="TV">Tuvalu</option>
                <option value="UG">Uganda</option>
                <option value="UA">Ukraine</option>
                <option value="AE">United Arab Emirates</option>
                <option value="GB">United Kingdom</option>
                <option value="US">United States</option>
                <option value="UM">United States Minor Outlying Islands</option>
                <option value="UY">Uruguay</option>
                <option value="UZ">Uzbekistan</option>
                <option value="VU">Vanuatu</option>
                <option value="VE">Venezuela</option>
                <option value="VN">Viet Nam</option>
                <option value="VG">Virgin Islands (British)</option>
                <option value="VI">Virgin Islands (U.S.)</option>
                <option value="WF">Wallis and Futuna Islands</option>
                <option value="EH">Western Sahara</option>
                <option value="YE">Yemen</option>
                <option value="ZM">Zambia</option>
                <option value="ZW">Zimbabwe</option>
            </select>
        </div>
    </div>

    <!-- end col -->


    <div class="col-lg-6">
        <div class="card-box">
            <h4 class="m-t-0 m-b-30 header-title"><b>Select2</b></h4>

            <h5><b>Single Select</b></h5>

            <select class="form-control select2">
                <option>Select</option>
                <optgroup label="Alaskan/Hawaiian Time Zone">
                    <option value="AK">Alaska</option>
                    <option value="HI">Hawaii</option>
                </optgroup>
                <optgroup label="Pacific Time Zone">
                    <option value="CA">California</option>
                    <option value="NV">Nevada</option>
                    <option value="OR">Oregon</option>
                    <option value="WA">Washington</option>
                </optgroup>
                <optgroup label="Mountain Time Zone">
                    <option value="AZ">Arizona</option>
                    <option value="CO">Colorado</option>
                    <option value="ID">Idaho</option>
                    <option value="MT">Montana</option>
                    <option value="NE">Nebraska</option>
                    <option value="NM">New Mexico</option>
                    <option value="ND">North Dakota</option>
                    <option value="UT">Utah</option>
                    <option value="WY">Wyoming</option>
                </optgroup>
                <optgroup label="Central Time Zone">
                    <option value="AL">Alabama</option>
                    <option value="AR">Arkansas</option>
                    <option value="IL">Illinois</option>
                    <option value="IA">Iowa</option>
                    <option value="KS">Kansas</option>
                    <option value="KY">Kentucky</option>
                    <option value="LA">Louisiana</option>
                    <option value="MN">Minnesota</option>
                    <option value="MS">Mississippi</option>
                    <option value="MO">Missouri</option>
                    <option value="OK">Oklahoma</option>
                    <option value="SD">South Dakota</option>
                    <option value="TX">Texas</option>
                    <option value="TN">Tennessee</option>
                    <option value="WI">Wisconsin</option>
                </optgroup>
                <optgroup label="Eastern Time Zone">
                    <option value="CT">Connecticut</option>
                    <option value="DE">Delaware</option>
                    <option value="FL">Florida</option>
                    <option value="GA">Georgia</option>
                    <option value="IN">Indiana</option>
                    <option value="ME">Maine</option>
                    <option value="MD">Maryland</option>
                    <option value="MA">Massachusetts</option>
                    <option value="MI">Michigan</option>
                    <option value="NH">New Hampshire</option>
                    <option value="NJ">New Jersey</option>
                    <option value="NY">New York</option>
                    <option value="NC">North Carolina</option>
                    <option value="OH">Ohio</option>
                    <option value="PA">Pennsylvania</option>
                    <option value="RI">Rhode Island</option>
                    <option value="SC">South Carolina</option>
                    <option value="VT">Vermont</option>
                    <option value="VA">Virginia</option>
                    <option value="WV">West Virginia</option>
                </optgroup>
            </select>

            <h5 class="m-t-30"><b>Multiple Select</b></h5>

            <select class="select2 select2-multiple" multiple="multiple" multiple data-placeholder="Choose ...">
                <optgroup label="Alaskan/Hawaiian Time Zone">
                    <option value="AK">Alaska</option>
                    <option value="HI">Hawaii</option>
                </optgroup>
                <optgroup label="Pacific Time Zone">
                    <option value="CA">California</option>
                    <option value="NV">Nevada</option>
                    <option value="OR">Oregon</option>
                    <option value="WA">Washington</option>
                </optgroup>
                <optgroup label="Mountain Time Zone">
                    <option value="AZ">Arizona</option>
                    <option value="CO">Colorado</option>
                    <option value="ID">Idaho</option>
                    <option value="MT">Montana</option>
                    <option value="NE">Nebraska</option>
                    <option value="NM">New Mexico</option>
                    <option value="ND">North Dakota</option>
                    <option value="UT">Utah</option>
                    <option value="WY">Wyoming</option>
                </optgroup>
                <optgroup label="Central Time Zone">
                    <option value="AL">Alabama</option>
                    <option value="AR">Arkansas</option>
                    <option value="IL">Illinois</option>
                    <option value="IA">Iowa</option>
                    <option value="KS">Kansas</option>
                    <option value="KY">Kentucky</option>
                    <option value="LA">Louisiana</option>
                    <option value="MN">Minnesota</option>
                    <option value="MS">Mississippi</option>
                    <option value="MO">Missouri</option>
                    <option value="OK">Oklahoma</option>
                    <option value="SD">South Dakota</option>
                    <option value="TX">Texas</option>
                    <option value="TN">Tennessee</option>
                    <option value="WI">Wisconsin</option>
                </optgroup>
                <optgroup label="Eastern Time Zone">
                    <option value="CT">Connecticut</option>
                    <option value="DE">Delaware</option>
                    <option value="FL">Florida</option>
                    <option value="GA">Georgia</option>
                    <option value="IN">Indiana</option>
                    <option value="ME">Maine</option>
                    <option value="MD">Maryland</option>
                    <option value="MA">Massachusetts</option>
                    <option value="MI">Michigan</option>
                    <option value="NH">New Hampshire</option>
                    <option value="NJ">New Jersey</option>
                    <option value="NY">New York</option>
                    <option value="NC">North Carolina</option>
                    <option value="OH">Ohio</option>
                    <option value="PA">Pennsylvania</option>
                    <option value="RI">Rhode Island</option>
                    <option value="SC">South Carolina</option>
                    <option value="VT">Vermont</option>
                    <option value="VA">Virginia</option>
                    <option value="WV">West Virginia</option>
                </optgroup>
            </select>

            <h5 class="m-t-30"><b>Limiting the number of selections</b></h5>

            <select class="select2-limiting" multiple="multiple">
                <optgroup label="Alaskan/Hawaiian Time Zone">
                    <option value="AK">Alaska</option>
                    <option value="HI">Hawaii</option>
                </optgroup>
                <optgroup label="Pacific Time Zone">
                    <option value="CA">California</option>
                    <option value="NV">Nevada</option>
                    <option value="OR">Oregon</option>
                    <option value="WA">Washington</option>
                </optgroup>
                <optgroup label="Mountain Time Zone">
                    <option value="AZ">Arizona</option>
                    <option value="CO">Colorado</option>
                    <option value="ID">Idaho</option>
                    <option value="MT">Montana</option>
                    <option value="NE">Nebraska</option>
                    <option value="NM">New Mexico</option>
                    <option value="ND">North Dakota</option>
                    <option value="UT">Utah</option>
                    <option value="WY">Wyoming</option>
                </optgroup>
                <optgroup label="Central Time Zone">
                    <option value="AL">Alabama</option>
                    <option value="AR">Arkansas</option>
                    <option value="IL">Illinois</option>
                    <option value="IA">Iowa</option>
                    <option value="KS">Kansas</option>
                    <option value="KY">Kentucky</option>
                    <option value="LA">Louisiana</option>
                    <option value="MN">Minnesota</option>
                    <option value="MS">Mississippi</option>
                    <option value="MO">Missouri</option>
                    <option value="OK">Oklahoma</option>
                    <option value="SD">South Dakota</option>
                    <option value="TX">Texas</option>
                    <option value="TN">Tennessee</option>
                    <option value="WI">Wisconsin</option>
                </optgroup>
                <optgroup label="Eastern Time Zone">
                    <option value="CT">Connecticut</option>
                    <option value="DE">Delaware</option>
                    <option value="FL">Florida</option>
                    <option value="GA">Georgia</option>
                    <option value="IN">Indiana</option>
                    <option value="ME">Maine</option>
                    <option value="MD">Maryland</option>
                    <option value="MA">Massachusetts</option>
                    <option value="MI">Michigan</option>
                    <option value="NH">New Hampshire</option>
                    <option value="NJ">New Jersey</option>
                    <option value="NY">New York</option>
                    <option value="NC">North Carolina</option>
                    <option value="OH">Ohio</option>
                    <option value="PA">Pennsylvania</option>
                    <option value="RI">Rhode Island</option>
                    <option value="SC">South Carolina</option>
                    <option value="VT">Vermont</option>
                    <option value="VA">Virginia</option>
                    <option value="WV">West Virginia</option>
                </optgroup>
            </select>
        </div>

        <div class="card-box">
            <h4 class="m-t-0 header-title"><b>Input Masks</b></h4>
            <p class="text-muted m-b-30 font-13">
                Use the button classes on an <code>&lt;a&gt;</code>, <code>&lt;button&gt;</code>, or <code>&lt;input&gt;</code> element.
            </p>
            <div class="row">
                <div class="col-md-6">
                    <div class="p-20">
                        <form action="#">
                            <div class="form-group">
                                <label>ISBN 1</label>
                                <input type="text" placeholder="" data-mask="999-99-999-9999-9" class="form-control">
                                <span class="font-13 text-muted">e.g "999-99-999-9999-9"</span>
                            </div>
                            <div class="form-group">
                                <label>ISBN 2</label>
                                <input type="text" placeholder="" data-mask="999 99 999 9999 9" class="form-control">
                                <span class="font-13 text-muted">999 99 999 9999 9</span>
                            </div>
                            <div class="form-group">
                                <label>ISBN 3</label>
                                <input type="text" placeholder="" data-mask="999/99/999/9999/9" class="form-control">
                                <span class="font-13 text-muted">999/99/999/9999/9</span>
                            </div>
                            <div class="form-group">
                                <label>IPV4</label>
                                <input type="text" placeholder="" data-mask="999.999.999.9999" class="form-control">
                                <span class="font-13 text-muted">192.168.110.310</span>
                            </div>
                            <div class="form-group m-b-0">
                                <label>IPV6</label>
                                <input type="text" placeholder="" data-mask="9999:9999:9999:9:999:9999:9999:9999" class="form-control">
                                <span class="font-13 text-muted">4deg:1340:6547:2:540:h8je:ve73:98pd</span>
                            </div>

                        </form>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="p-20">
                        <form action="#">

                            <div class="form-group">
                                <label>Tax ID</label>
                                <input type="text" placeholder="" data-mask="99-9999999" class="form-control">
                                <span class="font-13 text-muted">99-9999999</span>
                            </div>
                            <div class="form-group">
                                <label>Phone</label>
                                <input type="text" placeholder="" data-mask="(999) 999-9999" class="form-control">
                                <span class="font-13 text-muted">(999) 999-9999</span>
                            </div>
                            <div class="form-group">
                                <label>Currency</label>
                                <input type="text" placeholder="" data-mask="$ 999,999,999.99" class="form-control">
                                <span class="font-13 text-muted">$ 999,999,999.99</span>
                            </div>
                            <div class="form-group">
                                <label>Date</label>
                                <input type="text" placeholder="" data-mask="99/99/9999" class="form-control">
                                <span class="font-13 text-muted">dd/mm/yyyy</span>
                            </div>
                            <div class="form-group m-b-0">
                                <label>Date 2</label>
                                <input type="text" placeholder="" data-mask="99-99-9999" class="form-control">
                                <span class="font-13 text-muted">dd-mm-yyyy</span>
                            </div>

                        </form>
                    </div>
                </div>
            </div>

        </div>

    </div>
    <!-- end col -->
</div>
<!-- end row -->



<div class="row">
    <div class="col-sm-12">
        <div class="card-box">
            <h4 class="m-t-0 header-title"><b>Bootstrap TouchSpin</b></h4>
            <p class="text-muted font-13">
                You can limit the number of elements you are allowed to select via the
                <code>
                    data-max-option
                </code>
                attribute. It also works for option groups.
            </p>
            <div class="row">
                <div class="col-md-6">
                    <div class="p-20">
                        <form>
                            <div class="form-group">
                                <label class="control-label">Vertical button alignment</label>
                                <input class="vertical-spin" type="text" value="" name="vertical-spin">
                            </div>
                            <div class="form-group">
                                <label class="control-label">Using data attributes</label>
                                <input id="demo0" type="text" value="55" name="demo0" data-bts-min="0" data-bts-max="100" data-bts-init-val="" data-bts-step="1" data-bts-decimal="0" data-bts-step-interval="100" data-bts-force-step-divisibility="round" data-bts-step-interval-delay="500" data-bts-prefix="" data-bts-postfix="" data-bts-prefix-extra-class="" data-bts-postfix-extra-class="" data-bts-booster="true" data-bts-boostat="10" data-bts-max-boosted-step="false" data-bts-mousewheel="true" data-bts-button-down-class="btn btn-default" data-bts-button-up-class="btn btn-default"/>
                            </div>
                            <div class="form-group">
                                <label class="control-label">Example with postfix (large)</label>
                                <input id="demo1" type="text" value="55" name="demo1">
                            </div>
                            <div class="form-group m-b-0">
                                <label class="control-label">With prefix </label>
                                <input id="demo2" type="text" value="0" name="demo2" class=" form-control">
                            </div>

                        </form>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="p-20">
                        <form>

                            <div class="form-group">
                                <label class="control-label">Init with empty value:</label>
                                <input id="demo3" type="text" value="" name="demo3">
                            </div>
                            <div class="form-group">
                                <label class="control-label">Value attribute is not set (applying settings.initval)</label>
                                <input id="demo3_21" type="text" value="" name="demo3_21">
                            </div>
                            <div class="form-group">
                                <label class="control-label">Value is set explicitly to 33 (skipping settings.initval) </label>
                                <input id="demo3_22" type="text" value="33" name="demo3_22">
                            </div>
                            <div class="form-group m-b-0">
                                <label class="control-label">Button group</label>
                                <div class="input-group">
                                    <input id="demo5" type="text" class="form-control" name="demo5" value="50">
                                    <div class="input-group-btn">
                                        <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                                            <span class="caret"></span>
                                            <span class="sr-only">Toggle Dropdown</span>
                                        </button>
                                        <ul class="dropdown-menu pull-right" role="menu">
                                            <li>
                                                <a href="#">Action</a>
                                            </li>
                                            <li>
                                                <a href="#">Another action</a>
                                            </li>
                                            <li>
                                                <a href="#">Something else here</a>
                                            </li>
                                            <li class="divider"></li>
                                            <li>
                                                <a href="#">Separated link</a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- end row -->



<div class="row">
    <div class="col-sm-12">
        <div class="card-box">
            <div class="row">
                <div class="col-lg-6">
                    <h4 class="m-t-0 header-title"><b>Timepicker</b></h4>
                    <p class="text-muted font-13">
                        Easily select a time for a text input using your mouse or keyboards arrow keys.
                    </p>

                    <div class="p-20">
                        <label>Default Time Picker</label>
                        <div class="input-group m-b-15">

                            <div class="bootstrap-timepicker">
                                <input id="timepicker" type="text" class="form-control">
                            </div>
                            <span class="input-group-addon bg-primary b-0 text-white"><i class="glyphicon glyphicon-time"></i></span>
                        </div><!-- input-group -->

                        <label>24 Hour Mode Time Picker</label>
                        <div class="input-group m-b-15">

                            <div class="bootstrap-timepicker">
                                <input id="timepicker2" type="text" class="form-control">
                            </div>
                            <span class="input-group-addon bg-primary b-0 text-white"><i class="glyphicon glyphicon-time"></i></span>
                        </div><!-- input-group -->

                        <label>Specify a step for the minute field</label>
                        <div class="input-group m-b-0">

                            <div class="bootstrap-timepicker">
                                <input id="timepicker3" type="text" class="form-control">
                            </div>
                            <span class="input-group-addon bg-primary b-0 text-white"><i class="glyphicon glyphicon-time"></i></span>
                        </div><!-- input-group -->
                    </div>

                </div>

                <div class="col-lg-6">
                    <h4 class="m-t-0 header-title"><b>Colorpicker</b></h4>
                    <p class="text-muted font-13">
                        Add color picker to field or to any other element.
                    </p>

                    <div class="p-20">
                        <form action="#">
                            <div class="form-group">
                                <label>Default</label>
                                <input type="text" class="colorpicker-default form-control" value="#8fff00">
                            </div>
                            <div class="form-group">
                                <label>RGBA</label>
                                <input type="text" class="colorpicker-rgba form-control" value="rgb(0,194,255,0.78)" data-color-format="rgba">
                            </div>
                            <div class="form-group m-b-0">
                                <label>As Component</label>
                                <div data-color-format="rgb" data-color="rgb(255, 146, 180)" class="colorpicker-default input-group">
                                    <input type="text" readonly="readonly" value="" class="form-control">
															<span class="input-group-btn add-on">
																<button class="btn btn-white" type="button">
																	<i style="background-color: rgb(124, 66, 84);margin-top: 2px;"></i>
																</button>
															</span>
                                </div>
                            </div>
                        </form>

                    </div>

                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-sm-12">
        <div class="card-box">
            <div class="row">
                <div class="col-lg-10">
                    <h4 class="m-t-0 header-title"><b>Date Picker</b></h4>
                    <p class="text-muted font-13 m-b-30">
                        The datepicker is tied to a standard form input field. Click on the input to open
                        an interactive calendar in a small overlay. Click elsewhere on the page or hit the Esc
                        key to close. If a date is chosen, feedback is shown as the input's value.
                    </p>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-8">

                    <div class="p-20">
                        <form action="#" class="form-horizontal">
                            <div class="form-group">
                                <label class="control-label col-sm-4">Default Functionality</label>
                                <div class="col-sm-8">
                                    <div class="input-group">
                                        <input type="text" class="form-control" placeholder="mm/dd/yyyy" id="datepicker">
                                        <span class="input-group-addon bg-primary b-0 text-white"><i class="ion-calendar"></i></span>
                                    </div><!-- input-group -->
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-sm-4">Auto Close</label>
                                <div class="col-sm-8">
                                    <div class="input-group">
                                        <input type="text" class="form-control" placeholder="mm/dd/yyyy" id="datepicker-autoclose">
                                        <span class="input-group-addon bg-primary b-0 text-white"><i class="ion-calendar"></i></span>
                                    </div><!-- input-group -->
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-sm-4">Multiple Date</label>
                                <div class="col-sm-8">
                                    <div class="input-group">
                                        <input type="text" class="form-control" placeholder="mm/dd/yyyy" id="datepicker-multiple-date">
                                        <span class="input-group-addon bg-primary b-0 text-white"><i class="ion-calendar"></i></span>
                                    </div><!-- input-group -->
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-sm-4">Date Range</label>
                                <div class="col-sm-8">
                                    <div class="input-daterange input-group" id="date-range">
                                        <input type="text" class="form-control" name="start" />
                                        <span class="input-group-addon bg-primary b-0 text-white">to</span>
                                        <input type="text" class="form-control" name="end" />
                                    </div>
                                </div>
                            </div>

                        </form>
                    </div>



                </div>


                <div class="col-lg-4">

                    <div class="p-20">

                        <label>Display Inline</label>
                        <div class="input-group">
                            <div id="datepicker-inline"></div>
                        </div><!-- input-group -->

                    </div>



                </div>


            </div>
        </div>
    </div>
</div>



<div class="row">
    <div class="col-sm-12">
        <div class="card-box">
            <h4 class="m-t-0 header-title"><b>Date Range Picker</b></h4>

            <div class="row">
                <div class="col-lg-9">

                    <div class="p-20">
                        <form class="form-horizontal">
                            <div class="form-group">
                                <label class="col-lg-4 control-label">With all options</label>
                                <div class="col-lg-8">
                                    <div id="reportrange" class="pull-right form-control">
                                        <i class="glyphicon glyphicon-calendar fa fa-calendar"></i>
                                        <span></span>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-lg-4 control-label">Date Range Pick</label>
                                <div class="col-lg-8">
                                    <input class="form-control input-daterange-datepicker" type="text" name="daterange" value="01/01/2015 - 01/31/2015"/>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-lg-4 control-label">Date Range With Time</label>
                                <div class="col-lg-8">
                                    <input type="text" class="form-control input-daterange-timepicker" name="daterange" value="01/01/2015 1:30 PM - 01/01/2015 2:00 PM"/>
                                </div>
                            </div>
                            <div class="form-group m-b-0">
                                <label class="col-lg-4 control-label">Limit Selectable Dates</label>
                                <div class="col-lg-8">
                                    <input class="form-control input-limit-datepicker" type="text" name="daterange" value="06/01/2015 - 06/07/2015"/>
                                </div>
                            </div>
                        </form>

                    </div>

                </div>


            </div>
        </div>
    </div>
</div>






<?php require 'includes/footer_start.php' ?>

<script src="../plugins/bootstrap-tagsinput/dist/bootstrap-tagsinput.min.js"></script>
<script type="text/javascript" src="../plugins/jquery-quicksearch/jquery.quicksearch.js"></script>
<script src="../plugins/select2/select2.min.js" type="text/javascript"></script>
<script src="../plugins/bootstrap-touchspin/dist/jquery.bootstrap-touchspin.min.js" type="text/javascript"></script>
<script src="../plugins/bootstrap-inputmask/bootstrap-inputmask.min.js" type="text/javascript"></script>

<script src="../plugins/moment/moment.js"></script>
<script src="../plugins/timepicker/bootstrap-timepicker.min.js"></script>
<script src="../plugins/mjolnic-bootstrap-colorpicker/dist/js/bootstrap-colorpicker.min.js"></script>
<script src="../plugins/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
<script src="../plugins/bootstrap-daterangepicker/daterangepicker.js"></script>

<script>
    jQuery(document).ready(function() {

        //advance multiselect start
        $('#my_multi_select3').multiSelect({
            selectableHeader: "<input type='text' class='form-control search-input' autocomplete='off' placeholder='search...'>",
            selectionHeader: "<input type='text' class='form-control search-input' autocomplete='off' placeholder='search...'>",
            afterInit: function (ms) {
                var that = this,
                    $selectableSearch = that.$selectableUl.prev(),
                    $selectionSearch = that.$selectionUl.prev(),
                    selectableSearchString = '#' + that.$container.attr('id') + ' .ms-elem-selectable:not(.ms-selected)',
                    selectionSearchString = '#' + that.$container.attr('id') + ' .ms-elem-selection.ms-selected';

                that.qs1 = $selectableSearch.quicksearch(selectableSearchString)
                    .on('keydown', function (e) {
                        if (e.which === 40) {
                            that.$selectableUl.focus();
                            return false;
                        }
                    });

                that.qs2 = $selectionSearch.quicksearch(selectionSearchString)
                    .on('keydown', function (e) {
                        if (e.which == 40) {
                            that.$selectionUl.focus();
                            return false;
                        }
                    });
            },
            afterSelect: function () {
                this.qs1.cache();
                this.qs2.cache();
            },
            afterDeselect: function () {
                this.qs1.cache();
                this.qs2.cache();
            }
        });

        // Select2
        $(".select2").select2();

        $(".select2-limiting").select2({
            maximumSelectionLength: 2
        });

    });

    //Bootstrap-TouchSpin
    $(".vertical-spin").TouchSpin({
        verticalbuttons: true,
        buttondown_class: "btn btn-primary",
        buttonup_class: "btn btn-primary",
        verticalupclass: 'ion-plus-round',
        verticaldownclass: 'ion-minus-round'
    });
    var vspinTrue = $(".vertical-spin").TouchSpin({
        verticalbuttons: true
    });
    if (vspinTrue) {
        $('.vertical-spin').prev('.bootstrap-touchspin-prefix').remove();
    }

    $("input[name='demo1']").TouchSpin({
        min: 0,
        max: 100,
        step: 0.1,
        decimals: 2,
        boostat: 5,
        maxboostedstep: 10,
        buttondown_class: "btn btn-primary",
        buttonup_class: "btn btn-primary",
        postfix: '%'
    });
    $("input[name='demo2']").TouchSpin({
        min: -1000000000,
        max: 1000000000,
        stepinterval: 50,
        buttondown_class: "btn btn-primary",
        buttonup_class: "btn btn-primary",
        maxboostedstep: 10000000,
        prefix: '$'
    });
    $("input[name='demo3']").TouchSpin({
        buttondown_class: "btn btn-primary",
        buttonup_class: "btn btn-primary"
    });
    $("input[name='demo3_21']").TouchSpin({
        initval: 40,
        buttondown_class: "btn btn-primary",
        buttonup_class: "btn btn-primary"
    });
    $("input[name='demo3_22']").TouchSpin({
        initval: 40,
        buttondown_class: "btn btn-primary",
        buttonup_class: "btn btn-primary"
    });

    $("input[name='demo5']").TouchSpin({
        prefix: "pre",
        postfix: "post",
        buttondown_class: "btn btn-primary",
        buttonup_class: "btn btn-primary"
    });
    $("input[name='demo0']").TouchSpin({
        buttondown_class: "btn btn-primary",
        buttonup_class: "btn btn-primary"
    });

    // Time Picker
    jQuery('#timepicker').timepicker({
        defaultTIme : false
    });
    jQuery('#timepicker2').timepicker({
        showMeridian : false
    });
    jQuery('#timepicker3').timepicker({
        minuteStep : 15
    });

    //colorpicker start

    $('.colorpicker-default').colorpicker({
        format: 'hex'
    });
    $('.colorpicker-rgba').colorpicker();

    // Date Picker
    jQuery('#datepicker').datepicker();
    jQuery('#datepicker-autoclose').datepicker({
        autoclose: true,
        todayHighlight: true
    });
    jQuery('#datepicker-inline').datepicker();
    jQuery('#datepicker-multiple-date').datepicker({
        format: "mm/dd/yyyy",
        clearBtn: true,
        multidate: true,
        multidateSeparator: ","
    });
    jQuery('#date-range').datepicker({
        toggleActive: true
    });



    //Date range picker
    $('.input-daterange-datepicker').daterangepicker({
        buttonClasses: ['btn', 'btn-sm'],
        applyClass: 'btn-default',
        cancelClass: 'btn-primary'
    });
    $('.input-daterange-timepicker').daterangepicker({
        timePicker: true,
        format: 'MM/DD/YYYY h:mm A',
        timePickerIncrement: 30,
        timePicker12Hour: true,
        timePickerSeconds: false,
        buttonClasses: ['btn', 'btn-sm'],
        applyClass: 'btn-default',
        cancelClass: 'btn-primary'
    });
    $('.input-limit-datepicker').daterangepicker({
        format: 'MM/DD/YYYY',
        minDate: '06/01/2016',
        maxDate: '06/30/2016',
        buttonClasses: ['btn', 'btn-sm'],
        applyClass: 'btn-default',
        cancelClass: 'btn-primary',
        dateLimit: {
            days: 6
        }
    });

    $('#reportrange span').html(moment().subtract(29, 'days').format('MMMM D, YYYY') + ' - ' + moment().format('MMMM D, YYYY'));

    $('#reportrange').daterangepicker({
        format: 'MM/DD/YYYY',
        startDate: moment().subtract(29, 'days'),
        endDate: moment(),
        minDate: '01/01/2016',
        maxDate: '12/31/2016',
        dateLimit: {
            days: 60
        },
        showDropdowns: true,
        showWeekNumbers: true,
        timePicker: false,
        timePickerIncrement: 1,
        timePicker12Hour: true,
        ranges: {
            'Today': [moment(), moment()],
            'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
            'Last 7 Days': [moment().subtract(6, 'days'), moment()],
            'Last 30 Days': [moment().subtract(29, 'days'), moment()],
            'This Month': [moment().startOf('month'), moment().endOf('month')],
            'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
        },
        opens: 'left',
        drops: 'down',
        buttonClasses: ['btn', 'btn-sm'],
        applyClass: 'btn-success',
        cancelClass: 'btn-default',
        separator: ' to ',
        locale: {
            applyLabel: 'Submit',
            cancelLabel: 'Cancel',
            fromLabel: 'From',
            toLabel: 'To',
            customRangeLabel: 'Custom',
            daysOfWeek: ['Su', 'Mo', 'Tu', 'We', 'Th', 'Fr', 'Sa'],
            monthNames: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'],
            firstDay: 1
        }
    }, function (start, end, label) {
        console.log(start.toISOString(), end.toISOString(), label);
        $('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
    });


</script>

<?php require 'includes/footer_end.php' ?>

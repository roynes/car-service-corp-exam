<!DOCTYPE html>
<!--[if lt IE 7]>
    <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang="en">
<![endif]-->
<!--[if (IE 7)&!(IEMobile)]>
    <html class="no-js lt-ie9 lt-ie8" lang="en">
<![endif]-->
<!--[if (IE 8)&!(IEMobile)]>
    <html class="no-js lt-ie9" lang="en">
<![endif]-->
<!--[if gt IE 8]><!-->
    <html class="no-js" lang="en">
<!--<![endif]-->
<html>
	<head>
		<title>CarService Corp</title>

		<meta content="text/html;charset=utf-8" http-equiv="Content-Type">
		<meta content="utf-8" http-equiv="encoding">

		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta http-equiv="cleartype" content="on">
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">

		<meta name="description" content="">
		<meta name="author" content="">

		<!-- For all browsers -->
		<link rel="stylesheet" href="css/bootstrap.min.css">
		<link rel='stylesheet' href='css/0c560666356501ac2744809d2b92f7d1.css'>
		<link rel="stylesheet" href="css/check-out.css">
        <link rel="stylesheet" href="css/app.css">

		<link rel="shortcut icon" href="favicon.ico">
	</head>

	<body>
        {{--Main App--}}
		<div id="app">
            <nav class="topmenu fixed">
                <a href="index.html" class="logo-icon simple">
                    <img src="http://placehold.it/40x60&text=C" />
                </a>
                <h1 class="logo">
                   <a href="index.html"><img src="http://placehold.it/220x60&text=CarService Corp"></a>
                </h1>
                <div class="search">
                    <input type="text" placeholder="Hej, vad letar du efter?" class="input-large search-query"  id="searchbox" />
                    <a class="btn" href="search.html">
                        <i class="icon-search"></i>
                    </a>
                </div>
            </nav>

            <header class="header fixed" >
            </header>

            <div class="checkout-page container content-fixed">
                <div v-if="products.length != removedProducts.length">
                    {{--Item List--}}
                    <section class="basket-list">
                        <h1>1. Granska din kundvagn (Måste hämtas i butik)</h1>
                        <p>
                            Din kundvagn innehåller antingen <b>reservdelar</b> eller produkter som vi klassar som <b>farliga</b>,<b>skrymmande</b> eller <b>ömtåliga</b>.
                            Din beställning måste därför hämtas ut i någon av våra butiker.
                        </p>
                        <ul id="basket-item-list">
                            <li class="basket-item" v-for="(product, index) in products"  :id="'item-'+index">
                              <div class="product-item-image">
                                 <img src="http://placehold.it/100x100&text=Produktbild" />
                              </div>
                              <div class="product-item-description">
                                  <h2><a href="#">@{{ product.name }}</a></h2>
                                  <a href="#">Märk orderrad</a>
                              </div>
                              <div class="product-item-qtn">
                                  <input type="number" value="0" v-on:change="computeTotalFee($event,product)"/> st
                                  <p><b>I lager</b> 1-3 dagar</p>
                              </div>

                              <p class="product-item-price">x @{{ product.price }} kr</p>
                              <p class="product-item-total"> = @{{ product.price * product.quantity }} kr</p>

                              <p v-on:click="reComputeTotalFee(index, products)"><a href="#">Ta bort</a></p>
                            </li>
                        </ul>
                        <div class="basket-summary pull-right" v-if="products.length != removedProducts.length">
                            <ul>
                                 <li>
                                    <span>Faktura avgift: @{{ feeTotal }} kr</span>
                                </li>
                                <li>
                                    <span>Totalt inkl. moms @{{ feeTotalWitVat }} kr</span>
                                </li>

                            </ul>
                        </div>
                    </section>

                    {{--Delivery Method--}}
                    <section class="delivery">
                        <h1>Hur vill du ha din order levererad?</h1>
                        <label class="disable"><input type="radio" disabled="" />Hämta på Postens utlämningsställer (49kr)</label><br/>
                        <label class="disable"><input type="radio" disabled="" />Hem till dörren (249kr)</label><br/>
                        <label class="disable"><input type="radio" checked="checked" class="pull-left"/>Hämta i butik (49kr)</label><br/>
                        <div class="select-shop"><select><option>Välj butik</option></select></div>
                        <label class="disable"><input type="radio" class="pull-left" disabled="" />Företagspaket (100kr)</label><br/>
                        <span>Beräknad leveranstid: <b>1-3 dagar</b></span>
                    </section>

                    {{--Payment Method--}}
                    <section class="delivery">
                        <h1>Hur vill du betala?</h1>
                        <label><input type="radio" checked="checked"/>Faktura (29kr)</label><br/>
                        <label><input type="radio" />Klarna konto (0 kr)</label><br/>
                        <label><input type="radio"/>Visa eller MasterCard (0kr)</label><br/>
                        <label><input type="radio" />Via bank (0kr)</label><br/>
                    </section>

                    {{--Details--}}
                    <section class="delivery">
                        <h1>Ange dina uppgifter</h1>
                        <div style="margin-bottom: 30px;">
                            <label>
                                <input type="radio" name="detail-type" checked="checked"/>Privatperson/Enskild firma
                            </label>
                            <label>
                                <input type="radio" name="detail-type"/>Företag
                            </label>
                        </div>
                        <form role="form">
                            <div class="form-group row">
                              <label for="inputEmail1" class="col-sm-2 control-label" >Personnummer</label>
                              <div class="col-sm-4">
                                  <input type="text"
                                         :class="[errors.has('personnummer') ? 'input-err-validation-msg' : 'form-control']"
                                         id="inputEmail1"
                                         name="personnummer"
                                         v-validate
                                         data-rules="numeric"
                                         data-as="personal number"
                                  >
                                  <p v-show="errors.has('personnummer')"
                                        :class="['p-err-validation-msg']"
                                  >@{{ errors.first('personnummer') }}</p>
                              </div>
                            </div>
                            <div class="form-group row">
                                <label for="inputEmail2" class="col-sm-2 control-label">c/o</label>
                                <div class="col-sm-4">
                                  <input type="text" class="form-control" id="inputEmail2">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="inputEmail3" class="col-sm-2 control-label">Förnamn*</label>
                                <div class="col-sm-4">
                                    <input type="text"
                                           :class="[errors.has('first_name') ? 'input-err-validation-msg' : 'form-control']"
                                           id="inputEmail3"
                                           name="first_name"
                                           v-validate
                                           data-rules="required"
                                           data-as="first name"
                                    >
                                    <p v-show="errors.has('first_name')"
                                          :class="['p-err-validation-msg']"
                                    >@{{ errors.first('first_name') }}</p>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="inputEmail4" class="col-sm-2 control-label">Efternamn*</label>
                                <div class="col-sm-4">
                                    <input type="text"
                                           :class="[errors.has('last_name') ? 'input-err-validation-msg' : 'form-control']"
                                           id="inputEmail4"
                                           name="last_name"
                                           v-validate
                                           data-as="last name"
                                           data-rules="required"
                                    >
                                    <p v-show="errors.has('last_name')"
                                          :class="['p-err-validation-msg']"
                                    >@{{ errors.first('last_name') }}</p>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="inputEmail5" class="col-sm-2 control-label">Gatuadress*</label>
                                <div class="col-sm-4">
                                    <input type="text"
                                           :class="[errors.has('street_address') ? 'input-err-validation-msg' : 'form-control']"
                                           id="inputEmail5"
                                           name="street_address"
                                           v-validate
                                           data-as="street address"
                                           data-rules="required"
                                    >
                                    <p v-show="errors.has('street_address')"
                                          :class="['p-err-validation-msg']"
                                    >@{{ errors.first('street_address') }}</p>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="inputEmail6" class="col-sm-2 control-label">Postadress*</label>
                                <div class="col-sm-4">
                                    <input type="text"
                                           :class="[errors.has('mail_address') ? 'input-err-validation-msg' : 'form-control']"
                                           id="inputEmail6"
                                           name="mail_address"
                                           v-validate
                                           data-as="mailing address"
                                           data-rules="required"
                                    >
                                    <p v-show="errors.has('mail_address')"
                                          :class="['p-err-validation-msg']"
                                    >@{{ errors.first('mail_address') }}</p>
                                </div>
                            </div>
                            <div class="form-group row">
                            <label for="inputEmail7" class="col-sm-2 control-label">Mobiltelefonnummer*</label>
                                <div class="col-sm-4">
                                    <input type="text"
                                           :class="[errors.has('mobile_number') ? 'input-err-validation-msg' : 'form-control']"
                                           id="inputEmail7"
                                           name="mobile_number"
                                           v-validate
                                           data-as="mobile phone"
                                           data-rules="required|numeric"
                                    >
                                    <p v-show="errors.has('mobile_number')"
                                          :class="['p-err-validation-msg']"
                                    >@{{ errors.first('mobile_number') }}</p>
                                </div>
                            </div>
                            <div class="form-group row">
                            <label for="inputEmail8" class="col-sm-2 control-label">Epost*</label>
                                <div class="col-sm-4">
                                    <input type="email"
                                           :class="[errors.has('email') ? 'input-err-validation-msg' : 'form-control']"
                                           id="inputEmail8"
                                           name="email"
                                           v-validate
                                           data-as="e-mail"
                                           data-rules="required|email"
                                    >
                                    <p v-show="errors.has('email')"
                                          :class="['p-err-validation-msg']"
                                    >@{{ errors.first('email') }}</p>
                                </div>
                            </div>
                            <div class="form-group row">
                            <label for="inputEmail9" class="col-sm-2 control-label">Bekräfta epost*</label>
                                <div class="col-sm-4">
                                    <input type="email"
                                           :class="[errors.has('confirm_email') ? 'input-err-validation-msg' : 'form-control']"
                                           id="inputEmail9"
                                           name="confirm_email"
                                           v-validate
                                           data-as="e-mail"
                                           data-rules="required|email"
                                    >
                                    <p v-show="errors.has('confirm_email')"
                                          :class="['p-err-validation-msg']"
                                    >@{{ errors.first('confirm_email') }}</p>
                                </div>
                            </div>
                            <div><label><input type="checkbox" />Ja tack, jag vill ha nyhetsbrev från CarService Corp</label></div>
                            <div><i>* Obligatoriska fält</i></div>
                      </form>
                    </section>
                    </section>

                    <p class="center"><label><input type="checkbox" />Jag accepterar CarService Corp's <a href="#">köpvilkor</a></label></p>
                    <a :class="['btn', 'btn-large', !errors.any() ? 'confirm' : 'disabled']"
                       :disabled="errors.any()"
                       v-on:click="beforeSubmit($event)"
                    >
                        Skicka beställning
                    </a>
                </div>
                <div v-else>
                    ﻿<section class="delivery" style="margin-top: 30px;">
                        <h1 class="center">Du har en tom korg</h1>
                    </section>
                </div>
            </div>
		</div>

        {{--Scripts--}}
		<script type="text/javascript" src="js/app.js"></script>
	</body>
</html>
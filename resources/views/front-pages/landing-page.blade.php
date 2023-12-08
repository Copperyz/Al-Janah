@php
$customizerHidden = 'customizer-hide';

$configData = Helper::appClasses();
@endphp

@extends('layouts/layoutMaster')

@section('title', 'Landing - Front Pages')

@section('vendor-style')
<link rel="stylesheet" href="{{asset('assets/vendor/libs/nouislider/nouislider.css')}}" />
<link rel="stylesheet" href="{{asset('assets/vendor/libs/swiper/swiper.css')}}" />
@endsection

@section('page-style')
<link rel="stylesheet" href="{{asset('assets/vendor/css/pages/front-page-landing.css')}}" />
@endsection

@section('vendor-script')
<script src="{{asset('assets/vendor/libs/nouislider/nouislider.js')}}"></script>
<script src="{{asset('assets/vendor/libs/swiper/swiper.js')}}"></script>
@endsection

@section('page-script')
<script src="{{asset('assets/js/front-page-landing.js')}}"></script>
@endsection

@section('content')
<div data-bs-spy="scroll" class="scrollspy-example">
    <!-- Hero: Start -->
    <section id="hero-animation">
        <div id="landingHero" class="section-py landing-hero position-relative">
            <div class="container">
                <div class="hero-text-box text-center">
                    <h1 class="text-primary hero-title display-6 fw-bold">{{__('Elevate Your Cargo Experience')}}</h1>
                    <h2 class="hero-sub-title h6 mb-4 pb-1 fw-medium">
                        {{__('Seamless Air Cargo Solutions for Swift and Reliable Shipments')}}.
                    </h2>
                    <div class="landing-hero-btn d-inline-block position-relative">
                        <span class="hero-btn-item position-absolute d-none d-md-flex text-heading">{{__('Join us')}}
                            <img src="{{asset('assets/img/front-pages/icons/Join-community-arrow.png')}}"
                                alt="Join us arrow" class="scaleX-n1-rtl" /></span>
                        <a href="{{route('track-shipment')}}"
                            class="btn btn-primary btn-lg">{{__('Track your shipment')}}</a>
                    </div>
                </div>
                <!-- <div id="heroDashboardAnimation" class="hero-animation-img">
                    <a href="{{url('/')}}" target="_blank">
                        <div id="heroAnimationImg" class="position-relative hero-dashboard-img">
                            <img src="{{asset('assets/img/front-pages/landing-page/hero-dashboard-'.$configData['style'].'.png') }}"
                                alt="hero dashboard" class="animation-img"
                                data-app-light-img="front-pages/landing-page/hero-dashboard-light.png"
                                data-app-dark-img="front-pages/landing-page/hero-dashboard-dark.png" />
                            <img src="{{asset('assets/img/front-pages/landing-page/hero-elements-'.$configData['style'].'.png') }}"
                                alt="hero elements"
                                class="position-absolute hero-elements-img animation-img top-0 start-0"
                                data-app-light-img="front-pages/landing-page/hero-elements-light.png"
                                data-app-dark-img="front-pages/landing-page/hero-elements-dark.png" />

                        </div>
                    </a>
                </div> -->
                <div class="hero-animation-img text-center">
                    <svg version="1.1" id="hero-image" xmlns="http://www.w3.org/2000/svg"
                        xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 2041 1483"
                        style="enable-background:new 0 0 2041 1483;" xml:space="preserve" width="800" height="800">
                        <style type="text/css">
                        .st238 {
                            fill: none;
                            stroke: #84ff00;
                            stroke: #003670;
                            stroke: #80a9d4;
                            stroke-width: 16;
                            stroke-miterlimit: 10;
                            stroke-linecap: round;
                            stroke-dasharray: 30 30;
                            animation: dashedOut 1s linear infinite;
                        }

                        @keyframes dashedOut {
                            0% {
                                stroke-dashoffset: 0px;
                            }

                            100% {
                                stroke-dashoffset: -235px;
                            }
                        }

                        #SHIP {
                            transform: translateX(550px);
                            opacity: 0;
                            animation: shipEnter 2s linear forwards;
                        }

                        @keyframes shipEnter {
                            0% {
                                transform: translateX(550px);
                                opacity: 1;
                            }

                            100% {
                                transform: translateX(0);
                                opacity: 1;
                            }
                        }

                        /* ship to bags */
                        #JANAH-LINE-4 {
                            stroke: yellowgreen;
                            opacity: 0;
                            stroke-width: 13;
                            animation: lineMove 1s linear infinite 2s,
                                opacityAlter 3s ease-in-out forwards 1.5s;
                        }

                        @keyframes lineMove {
                            0% {
                                stroke-dasharray: 30 30;
                                stroke-dashoffset: 0;
                            }

                            100% {
                                stroke-dasharray: 30 30;
                                stroke-dashoffset: -235px;
                            }
                        }

                        @keyframes opacityAlter {
                            0% {
                                opacity: 0;
                            }

                            100% {
                                opacity: 1;
                            }
                        }

                        #BAGS {
                            transform: translateY(-150px);
                            transform-origin: 20 0;
                            opacity: 0;
                            animation: bagEnter 1s forwards 2.5s;
                        }

                        @keyframes bagEnter {
                            0% {
                                transform: translateY(-150px) rotateZ(-15deg);
                                opacity: 1;
                            }

                            30% {
                                transform: translateY(-100px) rotateZ(3deg);
                                opacity: 1;
                            }

                            60% {
                                transform: translateY(-50px) rotateZ(-2deg);
                                opacity: 1;
                            }

                            100% {
                                transform: translateY(0) rotateZ(0deg);
                                opacity: 1;
                            }
                        }

                        /* plane to box */
                        #JANAH-LINE-1 {
                            stroke: yellowgreen;
                            opacity: 0;
                            stroke-width: 13;
                            animation: lineMove 1s linear infinite 2s,
                                opacityAlter 3s ease-in-out forwards 1s;
                        }

                        #PLANE {
                            opacity: 0;
                            animation: planeEnter 1s forwards 1s;
                        }

                        @keyframes planeEnter {
                            0% {
                                transform: translate(-200px, 70px);
                                opacity: 0;
                            }

                            100% {
                                transform: translate(0, 0);
                                opacity: 1;
                            }
                        }

                        #BOX {
                            transform-origin: 331px 666px;
                            opacity: 0;
                            animation: boxEnter 1s forwards 2s;
                        }

                        @keyframes boxEnter {
                            0% {
                                transform: translateX(-150px);
                                transform: rotate(0);
                                opacity: 0;
                            }

                            100% {
                                transform: translateX(0);
                                transform: rotate(60deg);
                                opacity: 1;
                            }
                        }

                        #TRUCK-1 {
                            /* transform-origin: 331px 666px; */
                            opacity: 0;
                            animation: truckYellowEnter 1s forwards 1.25s;
                        }

                        @keyframes truckYellowEnter {
                            0% {
                                transform: translateX(-150px);
                                opacity: 0;
                            }

                            100% {
                                transform: translateX(0);
                                opacity: 1;
                            }
                        }

                        #TRUCK-2 {
                            /* transform-origin: 331px 666px; */
                            opacity: 0;
                            animation: truckGreenEnter 1s forwards 1.5s;
                        }

                        @keyframes truckGreenEnter {
                            0% {
                                transform: translateX(150px);
                                opacity: 0;
                            }

                            100% {
                                transform: translateX(0);
                                opacity: 1;
                            }
                        }

                        #HOUSE {
                            /* transform: scale(1.25); */
                            transform-origin: 1000px 900px;
                            opacity: 0;
                            animation: houseShow 1s forwards 3.5s;
                        }

                        @keyframes houseShow {
                            0% {
                                transform: scale(0);
                                opacity: 0;
                            }

                            50% {
                                transform: scale(1.12);
                                opacity: 0.5;
                            }

                            100% {
                                transform: scale(1);
                                opacity: 1;
                            }
                        }

                        /* box to truck */
                        #JANAH-LINE-2 {
                            stroke: #80a9d4;
                            opacity: 0;
                            stroke-width: 13;
                            animation: lineMove 1s linear infinite 2s,
                                opacityAlter 3s ease-in-out forwards 2.5s;
                        }

                        /* truck to truck */
                        #JANAH-LINE-3 {
                            stroke: yellowgreen;
                            opacity: 0;
                            stroke-width: 13;
                            animation: lineMove 1s linear infinite 2s,
                                opacityAlter 3s ease-in-out forwards 3.5s;
                        }

                        /* bags to house */
                        #JANAH-LINE-5 {
                            stroke: #80a9d4;
                            opacity: 0;
                            stroke-width: 13;
                            animation: lineMove 1s linear infinite 2s,
                                opacityAlter 3s ease-in-out forwards 3s;
                        }

                        .st0 {
                            fill: url(#SVGID_1_);
                        }

                        .st1 {
                            fill: url(#SVGID_00000008852005731357163680000016666896926794887064_);
                        }

                        .st2 {
                            fill: #F19A39;
                        }

                        .st3 {
                            opacity: 0.5;
                        }

                        .st4 {
                            fill: #80A9D4;
                        }

                        .st5 {
                            fill: #E45A3B;
                        }

                        .st6 {
                            fill: url(#SVGID_00000067196428138081674580000017601550240337663414_);
                        }

                        .st7 {
                            fill: url(#SVGID_00000015337630441807822730000013326867404667856790_);
                        }

                        .st8 {
                            fill: url(#SVGID_00000069367890625438861990000006194556261022382512_);
                        }

                        .st9 {
                            fill: url(#SVGID_00000138536664672771462880000007967422923841224636_);
                        }

                        .st10 {
                            fill: url(#SVGID_00000065756958144281545480000013667136669159691438_);
                        }

                        .st11 {
                            fill: url(#SVGID_00000152985767380210935990000017136293127863392896_);
                        }

                        .st12 {
                            fill: none;
                            stroke: url(#SVGID_00000103951676353846440010000008076305670233328563_);
                            stroke-width: 0.75;
                            stroke-linecap: round;
                        }

                        .st13 {
                            fill: #3A92EA;
                        }

                        .st14 {
                            fill: url(#SVGID_00000113318653987386977710000009561050712476187830_);
                        }

                        .st15 {
                            fill: url(#SVGID_00000007407866483621053890000013521204662577987972_);
                        }

                        .st16 {
                            fill: url(#SVGID_00000179625512617170877420000009758050063819490731_);
                        }

                        .st17 {
                            fill: #3A91ED;
                        }

                        .st18 {
                            fill: url(#SVGID_00000119825028261020747010000001254304973405046193_);
                        }

                        .st19 {
                            fill: url(#SVGID_00000034794622480014770720000007460934164527867268_);
                        }

                        .st20 {
                            fill: url(#SVGID_00000050646207915937923930000015035264478832373385_);
                        }

                        .st21 {
                            opacity: 0.35;
                        }

                        .st22 {
                            fill: #FFFFFF;
                        }

                        .st23 {
                            fill: #3A8FF0;
                        }

                        .st24 {
                            fill: url(#SVGID_00000034804769183359154960000004902206772207171212_);
                        }

                        .st25 {
                            fill: url(#SVGID_00000011001678192350529090000009820325793973859519_);
                        }

                        .st26 {
                            fill: url(#SVGID_00000173147945544929033510000010147714913478535052_);
                        }

                        .st27 {
                            fill: none;
                            stroke: url(#SVGID_00000020367649471967169440000005900405813377156283_);
                            stroke-width: 0.75;
                            stroke-linecap: round;
                        }

                        .st28 {
                            fill: none;
                            stroke: #4EB7F5;
                            stroke-width: 0.75;
                            stroke-linecap: round;
                        }

                        .st29 {
                            fill: url(#SVGID_00000049930923361522299350000000037940426061099937_);
                        }

                        .st30 {
                            fill: url(#SVGID_00000106127216305024158150000011199041568100479118_);
                        }

                        .st31 {
                            fill: url(#SVGID_00000042715793708584837980000011807804987022202784_);
                        }

                        .st32 {
                            fill: url(#SVGID_00000008121122979536141380000012618240928987472782_);
                        }

                        .st33 {
                            fill: url(#SVGID_00000106838246725672820830000001550780873105707430_);
                        }

                        .st34 {
                            fill: url(#SVGID_00000107569751347749981510000012831741040389934268_);
                        }

                        .st35 {
                            fill: url(#SVGID_00000125575405221050391470000007985591125173225100_);
                        }

                        .st36 {
                            fill: url(#SVGID_00000066511673490921709690000003830176059649333169_);
                        }

                        .st37 {
                            fill: url(#SVGID_00000140723260933997095670000005780446915200370339_);
                        }

                        .st38 {
                            fill: url(#SVGID_00000016782527558410725620000002930409009144672690_);
                        }

                        .st39 {
                            fill: url(#SVGID_00000002374272062389902330000003539630515535481729_);
                        }

                        .st40 {
                            fill: #D7D4E2;
                        }

                        .st41 {
                            fill: url(#SVGID_00000023983633054994952970000009492096755455268242_);
                        }

                        .st42 {
                            fill: url(#SVGID_00000047040887516112580190000000905970028014374544_);
                        }

                        .st43 {
                            fill: url(#SVGID_00000020363743240953055470000002046924253436707722_);
                        }

                        .st44 {
                            fill: url(#SVGID_00000106106676338962419080000017503742485986435758_);
                        }

                        .st45 {
                            fill-rule: evenodd;
                            clip-rule: evenodd;
                            fill: url(#SVGID_00000026137504702039841350000017199395892064829830_);
                        }

                        .st46 {
                            fill-rule: evenodd;
                            clip-rule: evenodd;
                            fill: url(#SVGID_00000157274912596831786900000000200550861669292207_);
                        }

                        .st47 {
                            fill-rule: evenodd;
                            clip-rule: evenodd;
                            fill: url(#SVGID_00000090293092177217536130000012951855823787934089_);
                        }

                        .st48 {
                            fill: url(#SVGID_00000105394631996998412710000007928629621933540256_);
                        }

                        .st49 {
                            fill: url(#SVGID_00000111179908152813470580000008201183856230491782_);
                        }

                        .st50 {
                            fill: url(#SVGID_00000005980633957348042130000006685105666181586366_);
                        }

                        .st51 {
                            fill: url(#SVGID_00000128471897758734711450000017675594704108202411_);
                        }

                        .st52 {
                            fill: none;
                            stroke: url(#SVGID_00000041285459490657039450000003430244904232857511_);
                            stroke-width: 0.25;
                            stroke-linecap: round;
                        }

                        .st53 {
                            fill: #328A65;
                        }

                        .st54 {
                            fill: url(#SVGID_00000003074058164804419300000017324608638679431815_);
                        }

                        .st55 {
                            fill: url(#SVGID_00000045581965715217870380000006412987345965374390_);
                        }

                        .st56 {
                            fill: url(#SVGID_00000054231005590995521660000005967107821835065776_);
                        }

                        .st57 {
                            fill-rule: evenodd;
                            clip-rule: evenodd;
                            fill: url(#SVGID_00000179607670531455640490000003140213228014998944_);
                        }

                        .st58 {
                            fill: url(#SVGID_00000044863786975485741360000000293414718617537960_);
                        }

                        .st59 {
                            fill: url(#SVGID_00000110446191163328283230000004552755492784486288_);
                        }

                        .st60 {
                            fill: url(#SVGID_00000052814812497252159730000007508876904388554891_);
                        }

                        .st61 {
                            fill: url(#SVGID_00000152236994238210513260000001806372482960481723_);
                        }

                        .st62 {
                            fill: url(#SVGID_00000052097246376868159680000016638676325262783109_);
                        }

                        .st63 {
                            fill: url(#SVGID_00000168814966409444412440000017821840650899828374_);
                        }

                        .st64 {
                            fill: url(#SVGID_00000008124029485664745330000009463349456305748899_);
                        }

                        .st65 {
                            fill: url(#SVGID_00000011019579355254448800000003242184200372731279_);
                        }

                        .st66 {
                            fill: url(#SVGID_00000031200782371050750000000004939072204721623941_);
                        }

                        .st67 {
                            fill: url(#SVGID_00000021113380973923809710000008963971195822566036_);
                        }

                        .st68 {
                            fill: url(#SVGID_00000026161983227078217740000017839441804726910911_);
                        }

                        .st69 {
                            fill: url(#SVGID_00000012469158046921220010000003037964517093930936_);
                        }

                        .st70 {
                            fill: url(#SVGID_00000160174838063799491590000003671091190792214707_);
                        }

                        .st71 {
                            fill: url(#SVGID_00000031196482084044128570000011620299164870025125_);
                        }

                        .st72 {
                            fill: url(#SVGID_00000015332083330250823020000015258040915332793516_);
                        }

                        .st73 {
                            fill: url(#SVGID_00000152967362499538465370000009004228830265889175_);
                        }

                        .st74 {
                            fill: url(#SVGID_00000110453411418787844890000005172325222890218384_);
                        }

                        .st75 {
                            fill: url(#SVGID_00000076574831649809024630000016789146246805448078_);
                        }

                        .st76 {
                            fill: url(#SVGID_00000165931773064089193190000008692982484573202076_);
                        }

                        .st77 {
                            fill: url(#SVGID_00000032648414722362032460000016541191082571471783_);
                        }

                        .st78 {
                            fill: url(#SVGID_00000155829840507912791610000000200728631375747717_);
                        }

                        .st79 {
                            fill: #F3CF4D;
                        }

                        .st80 {
                            fill: url(#SVGID_00000097480033498484597540000012852527594281099655_);
                        }

                        .st81 {
                            fill: url(#SVGID_00000162349997886862785310000004280389395235954074_);
                        }

                        .st82 {
                            fill: url(#SVGID_00000168796441238850522240000014439496072943642789_);
                        }

                        .st83 {
                            fill: url(#SVGID_00000090252670818951636670000010094189044888413359_);
                        }

                        .st84 {
                            fill: url(#SVGID_00000078731740828241387850000009800811018441524921_);
                        }

                        .st85 {
                            fill: url(#SVGID_00000117652760973828838280000011928012154599882369_);
                        }

                        .st86 {
                            fill: url(#SVGID_00000160172363114775687020000016189709595982803607_);
                        }

                        .st87 {
                            fill: #CDC5D5;
                        }

                        .st88 {
                            fill: url(#SVGID_00000163785824174107740860000018088736396241854859_);
                        }

                        .st89 {
                            fill: url(#SVGID_00000062895993181338966870000017123662912589622959_);
                        }

                        .st90 {
                            fill: url(#SVGID_00000165216522015762081530000003676237264043078536_);
                        }

                        .st91 {
                            fill: url(#SVGID_00000056406281025288920190000002299105616100854181_);
                        }

                        .st92 {
                            fill: none;
                            stroke: url(#SVGID_00000052089266707109619250000010439049399638276227_);
                            stroke-width: 0.85;
                        }

                        .st93 {
                            fill: none;
                            stroke: url(#SVGID_00000005231826824464654220000016018307208437841051_);
                            stroke-width: 0.85;
                        }

                        .st94 {
                            fill: none;
                            stroke: url(#SVGID_00000072270655371321616890000012428541040643100828_);
                            stroke-width: 0.85;
                        }

                        .st95 {
                            fill: none;
                            stroke: url(#SVGID_00000128459637670727545740000001242299655698767502_);
                            stroke-width: 0.5;
                            stroke-linecap: round;
                        }

                        .st96 {
                            fill-rule: evenodd;
                            clip-rule: evenodd;
                            fill: url(#SVGID_00000083059367232968529360000011811172160724373672_);
                        }

                        .st97 {
                            fill-rule: evenodd;
                            clip-rule: evenodd;
                            fill: url(#SVGID_00000183232598701339379320000012590210057009549470_);
                        }

                        .st98 {
                            fill: url(#SVGID_00000121267277785936159750000001761476964685067394_);
                        }

                        .st99 {
                            fill: url(#SVGID_00000035498666807947015910000003950591916855585969_);
                        }

                        .st100 {
                            fill: url(#SVGID_00000037678963584445879900000004189368036034117016_);
                        }

                        .st101 {
                            fill: url(#SVGID_00000135692322704957559740000016487319441797095341_);
                        }

                        .st102 {
                            fill: url(#SVGID_00000091730561008207425560000000578051344862257062_);
                        }

                        .st103 {
                            fill: url(#SVGID_00000138536377959861163300000009215596021918762939_);
                        }

                        .st104 {
                            fill: url(#SVGID_00000003789814229873701940000002864898428314629554_);
                        }

                        .st105 {
                            fill: url(#SVGID_00000048488192249040738130000002238843340169259708_);
                        }

                        .st106 {
                            fill: url(#SVGID_00000102506987339222776830000014305391834392443535_);
                        }

                        .st107 {
                            fill: url(#SVGID_00000116193330204297875430000014640585793004105400_);
                        }

                        .st108 {
                            fill: url(#SVGID_00000031895977472062249460000008968023242386386357_);
                        }

                        .st109 {
                            fill: url(#SVGID_00000048478542038924262770000005420977062605630127_);
                        }

                        .st110 {
                            fill: url(#SVGID_00000094599453035848655490000013912348292875216539_);
                        }

                        .st111 {
                            fill: #D9C3F0;
                        }

                        .st112 {
                            fill: url(#SVGID_00000039134351159731982150000006385538922441215134_);
                        }

                        .st113 {
                            fill: url(#SVGID_00000167362721610314969550000017132459637792871835_);
                        }

                        .st114 {
                            fill: url(#SVGID_00000141440666712311545380000006504989161817000628_);
                        }

                        .st115 {
                            fill: url(#SVGID_00000063632151130122145720000005687724312715682451_);
                        }

                        .st116 {
                            fill: url(#SVGID_00000181768144165501227080000012557491040026038921_);
                        }

                        .st117 {
                            fill-rule: evenodd;
                            clip-rule: evenodd;
                            fill: url(#SVGID_00000075845783736033706990000015227604892945043878_);
                        }

                        .st118 {
                            fill-rule: evenodd;
                            clip-rule: evenodd;
                            fill: url(#SVGID_00000135656674664475209630000017344470887361352382_);
                        }

                        .st119 {
                            fill: url(#SVGID_00000065758658596879396530000001769417406597437611_);
                        }

                        .st120 {
                            fill: url(#SVGID_00000129920940877970550290000012183454526815023516_);
                        }

                        .st121 {
                            fill: #F8DA4B;
                        }

                        .st122 {
                            fill: url(#SVGID_00000080192670385584634950000007923162599440628654_);
                        }

                        .st123 {
                            fill: url(#SVGID_00000119830777992125871850000015552155637304621193_);
                        }

                        .st124 {
                            fill: none;
                            stroke: url(#SVGID_00000123419273919792978450000004594085940667486630_);
                            stroke-width: 0.85;
                        }

                        .st125 {
                            fill: none;
                            stroke: url(#SVGID_00000078043127741125801960000010458908933442278541_);
                            stroke-width: 0.85;
                        }

                        .st126 {
                            fill: url(#SVGID_00000140704461891951638110000016838911401370194849_);
                        }

                        .st127 {
                            fill: url(#SVGID_00000108275359627212057690000003414846671661724085_);
                        }

                        .st128 {
                            fill: url(#SVGID_00000155860765295131691680000005146539845818321801_);
                        }

                        .st129 {
                            fill: url(#SVGID_00000059277799390023496170000015647041158924924556_);
                        }

                        .st130 {
                            fill: url(#SVGID_00000124855883258137286230000007142457748062646659_);
                        }

                        .st131 {
                            fill: url(#SVGID_00000024703243820409068400000017773071700659513257_);
                        }

                        .st132 {
                            fill: url(#SVGID_00000011736505368818122600000016560450404950158235_);
                        }

                        .st133 {
                            fill: url(#SVGID_00000124856833337366228840000004816989728459211690_);
                        }

                        .st134 {
                            fill: url(#SVGID_00000084530465883716063610000018311470426217953720_);
                        }

                        .st135 {
                            fill: url(#SVGID_00000132787018741799684380000011816984898682964653_);
                        }

                        .st136 {
                            fill: url(#SVGID_00000137095427136911519380000008615562472032511624_);
                        }

                        .st137 {
                            fill: url(#SVGID_00000039811922838802960480000006195086291478475682_);
                        }

                        .st138 {
                            fill: url(#SVGID_00000165207956428481102360000001347631977546386061_);
                        }

                        .st139 {
                            fill: url(#SVGID_00000029742572109374803720000016946835005795039363_);
                        }

                        .st140 {
                            fill: none;
                            stroke: url(#SVGID_00000127023865627471883960000009964063440775304346_);
                            stroke-width: 0.3;
                            stroke-linecap: round;
                        }

                        .st141 {
                            fill: none;
                            stroke: url(#SVGID_00000052792702362649475550000005015157267568215938_);
                            stroke-width: 0.3;
                            stroke-linecap: round;
                            stroke-opacity: 0.5;
                        }

                        .st142 {
                            fill: url(#SVGID_00000067952554416734112800000002484630097916040365_);
                        }

                        .st143 {
                            fill: url(#SVGID_00000080898943493237858210000006588654316029354369_);
                        }

                        .st144 {
                            fill: url(#SVGID_00000080198917702698089820000002339859387909306780_);
                        }

                        .st145 {
                            fill: url(#SVGID_00000166645157449530139530000004734104704084735932_);
                        }

                        .st146 {
                            fill: url(#SVGID_00000023990001188221142020000009493959188857750441_);
                        }

                        .st147 {
                            fill: url(#SVGID_00000137097645745243093500000015870211634309508262_);
                        }

                        .st148 {
                            fill: url(#SVGID_00000008126355618331769450000002262177804477049513_);
                        }

                        .st149 {
                            fill: url(#SVGID_00000092424266592186045580000011058501894454326169_);
                        }

                        .st150 {
                            fill: url(#SVGID_00000080186129922956604620000003247221040188855486_);
                        }

                        .st151 {
                            fill: url(#SVGID_00000147217614211995293620000014873579655779815059_);
                        }

                        .st152 {
                            fill: url(#SVGID_00000041980009629204004020000010436201167302151348_);
                        }

                        .st153 {
                            fill: url(#SVGID_00000080891945158288591280000003630874898167787650_);
                        }

                        .st154 {
                            fill: url(#SVGID_00000000184382404107811120000011281899907902648467_);
                        }

                        .st155 {
                            fill: url(#SVGID_00000098936597766090183270000013954779634336424894_);
                        }

                        .st156 {
                            fill: url(#SVGID_00000100346212167355411210000013745378305505760897_);
                        }

                        .st157 {
                            fill: url(#SVGID_00000110446811325487719470000004462746123578073767_);
                        }

                        .st158 {
                            fill: url(#SVGID_00000011743916508885364700000015425026804763643575_);
                        }

                        .st159 {
                            fill: url(#SVGID_00000148627802250785331900000009987273489202253704_);
                        }

                        .st160 {
                            fill: url(#SVGID_00000114034164836292422640000003897998752498570652_);
                        }

                        .st161 {
                            fill: none;
                            stroke: url(#SVGID_00000111184493222149701110000016618588744216429745_);
                            stroke-width: 0.3;
                            stroke-linecap: round;
                        }

                        .st162 {
                            fill: none;
                            stroke: url(#SVGID_00000135648521259274322470000017223922986360154038_);
                            stroke-width: 0.3;
                            stroke-linecap: round;
                            stroke-opacity: 0.5;
                        }

                        .st163 {
                            fill: url(#SVGID_00000170256891642301076160000011770358750186930826_);
                        }

                        .st164 {
                            fill: url(#SVGID_00000124163700364543006050000003102359254909594786_);
                        }

                        .st165 {
                            fill: url(#SVGID_00000183220083072010355710000002959397799029256347_);
                        }

                        .st166 {
                            fill: url(#SVGID_00000076590083710815812920000017474261610374652050_);
                        }

                        .st167 {
                            fill: url(#SVGID_00000170999930818466562800000017635913182644958907_);
                        }

                        .st168 {
                            fill: url(#SVGID_00000165202363148713258540000012798241128449162170_);
                        }

                        .st169 {
                            fill: url(#SVGID_00000040570986548162200370000001493112696445333433_);
                        }

                        .st170 {
                            fill: url(#SVGID_00000025402935889298342210000010512301049844562328_);
                        }

                        .st171 {
                            fill: url(#SVGID_00000154407940868679204330000007656971472644549529_);
                        }

                        .st172 {
                            fill: url(#SVGID_00000005971745064430259880000015619043418197505466_);
                        }

                        .st173 {
                            fill: url(#SVGID_00000026147571696043981610000018341108553705971081_);
                        }

                        .st174 {
                            fill: url(#SVGID_00000163770520105354002130000007668012750015729595_);
                        }

                        .st175 {
                            fill: url(#SVGID_00000071541842309590531040000013191374508435983801_);
                        }

                        .st176 {
                            fill: #62393D;
                        }

                        .st177 {
                            fill: url(#SVGID_00000118388536298932721540000010926953163665659788_);
                        }

                        .st178 {
                            fill: #895D56;
                        }

                        .st179 {
                            fill: url(#SVGID_00000035515233197399901440000005168777106963724728_);
                        }

                        .st180 {
                            fill: url(#SVGID_00000071534370139526858370000016564590583684313220_);
                        }

                        .st181 {
                            fill: url(#SVGID_00000114786159667371837630000004031057383182436001_);
                        }

                        .st182 {
                            fill: none;
                            stroke: url(#SVGID_00000122710409957361006730000017444550168577173394_);
                            stroke-width: 0.3;
                            stroke-linecap: round;
                        }

                        .st183 {
                            fill: none;
                            stroke: url(#SVGID_00000038373519726398687660000010595793457107010966_);
                            stroke-width: 0.3;
                            stroke-linecap: round;
                            stroke-opacity: 0.5;
                        }

                        .st184 {
                            fill: #2EAD69;
                        }

                        .st185 {
                            fill: url(#SVGID_00000106869829597217744470000014733606768909129861_);
                        }

                        .st186 {
                            fill: url(#SVGID_00000026156369032321889120000009678561673391180952_);
                        }

                        .st187 {
                            fill: url(#SVGID_00000072959205563076930800000012367695185071882669_);
                        }

                        .st188 {
                            fill: url(#SVGID_00000032620424675782722140000016105561017638324620_);
                        }

                        .st189 {
                            fill: url(#SVGID_00000002360785012616087030000011159986495251002783_);
                        }

                        .st190 {
                            fill: url(#SVGID_00000140709134212692362470000012686902160563250877_);
                        }

                        .st191 {
                            fill: #3ABD6C;
                        }

                        .st192 {
                            fill: url(#SVGID_00000043417817528032107970000002657013705702107289_);
                        }

                        .st193 {
                            fill: url(#SVGID_00000008864274068509949470000015681138408107520907_);
                        }

                        .st194 {
                            fill: url(#SVGID_00000040537891968417537150000014323932520191400127_);
                        }

                        .st195 {
                            fill: #2BA75C;
                        }

                        .st196 {
                            fill: url(#SVGID_00000171681132447362961820000001208583198128873357_);
                        }

                        .st197 {
                            fill: url(#SVGID_00000160871137558484058430000001299878198316902838_);
                        }

                        .st198 {
                            fill: url(#SVGID_00000124870411863057194110000014120000761140885916_);
                        }

                        .st199 {
                            fill: url(#SVGID_00000110431496749431840510000006937646610496148124_);
                        }

                        .st200 {
                            fill: url(#SVGID_00000171681483964928175480000004221573263261495939_);
                        }

                        .st201 {
                            fill: url(#SVGID_00000151530972243426507590000007805021547703470245_);
                        }

                        .st202 {
                            fill: url(#SVGID_00000069387637926426679980000011904227308949437105_);
                        }

                        .st203 {
                            fill: url(#SVGID_00000175313636566243628770000007153072292655943072_);
                        }

                        .st204 {
                            fill: #31B570;
                        }

                        .st205 {
                            fill: url(#SVGID_00000045601003891241411290000013980420436117606794_);
                        }

                        .st206 {
                            fill: url(#SVGID_00000155146989203515511100000017159500493167191195_);
                        }

                        .st207 {
                            fill: url(#SVGID_00000124161130287720395340000014308334222284055711_);
                        }

                        .st208 {
                            opacity: 0.6;
                        }

                        .st209 {
                            fill: #003670;
                        }

                        .st210 {
                            fill: url(#SVGID_00000109028473855226682470000006781953091075761058_);
                        }

                        .st211 {
                            fill: url(#SVGID_00000070100641689725599020000002498311061546607775_);
                        }

                        .st212 {
                            fill: url(#SVGID_00000011743837680369810730000014024848928739370413_);
                        }

                        .st213 {
                            fill: #966957;
                        }

                        .st214 {
                            fill: url(#SVGID_00000160176006326706356970000014495381205993161917_);
                        }

                        .st215 {
                            fill: url(#SVGID_00000008833454497880666200000012820749278506854023_);
                        }

                        .st216 {
                            fill: none;
                            stroke: #A47E73;
                            stroke-width: 5.000000e-02;
                        }

                        .st217 {
                            fill: none;
                            stroke: #F4CAA3;
                            stroke-width: 0.2;
                            stroke-linecap: round;
                        }

                        .st218 {
                            fill: url(#SVGID_00000182487709650639603190000006547421450259039140_);
                        }

                        .st219 {
                            fill: url(#SVGID_00000148629972915044715600000016483109196760259998_);
                        }

                        .st220 {
                            fill: url(#SVGID_00000164511930641521099570000010556710906552272816_);
                        }

                        .st221 {
                            fill: url(#SVGID_00000034086082232706428450000010229008376846543778_);
                        }

                        .st222 {
                            fill: #56E6FF;
                        }

                        .st223 {
                            fill: url(#SVGID_00000129170284312197812780000014347400772837345950_);
                        }

                        .st224 {
                            fill: url(#SVGID_00000093895360400764810240000011103164253065319567_);
                        }

                        .st225 {
                            fill: url(#SVGID_00000030483867988732741100000010789027150861337531_);
                        }

                        .st226 {
                            fill: url(#SVGID_00000001653446682527246300000003259516099510823858_);
                        }

                        .st227 {
                            fill: url(#SVGID_00000003066000972257608890000015119701093265135792_);
                        }

                        .st228 {
                            fill: url(#SVGID_00000036929650724084618630000006112502859395346335_);
                        }

                        .st229 {
                            fill: url(#SVGID_00000032614703794006486490000004034251758659371435_);
                        }

                        .st230 {
                            fill: url(#SVGID_00000045595082051755189400000011242137905997085621_);
                        }

                        .st231 {
                            fill: url(#SVGID_00000170253585545808010060000005275259533216948624_);
                        }

                        .st232 {
                            fill: url(#SVGID_00000070804182606463883030000011368066876074367124_);
                        }

                        .st233 {
                            fill: url(#SVGID_00000056415957651619633930000008031185464670536884_);
                        }

                        .st234 {
                            fill: #E1D9E7;
                        }

                        .st235 {
                            fill: url(#SVGID_00000156581777543774345180000018441991608593521855_);
                        }

                        .st236 {
                            fill: url(#SVGID_00000166672798909768256180000017778862012209872774_);
                        }

                        .st237 {
                            fill: #63FAFF;
                        }

                        .st238 {
                            fill: none;
                            stroke: #80a9d4;
                            stroke-width: 6;
                            stroke-miterlimit: 10;
                        }
                        </style>
                        <g id="BAGS">
                            <g>

                                <linearGradient id="SVGID_1_" gradientUnits="userSpaceOnUse" x1="1675.0674"
                                    y1="1067.0059" x2="1726.875" y2="977.4619"
                                    gradientTransform="matrix(1 0 0 -1 0 1483.7244)">
                                    <stop offset="0" style="stop-color:#FEC243" />
                                    <stop offset="1" style="stop-color:#FDB046" />
                                </linearGradient>
                                <path class="st0" d="M1628.9,397.7c0-5.7,4.6-10.2,10.2-10.2h133.4c5.7,0,10.2,4.6,10.2,10.2v144.5c0,5.7-4.6,10.2-10.2,10.2
			h-133.4c-5.7,0-10.2-4.6-10.2-10.2V397.7z" />

                                <radialGradient id="SVGID_00000155832209708078965150000003448091086697147052_"
                                    cx="-1474.8464" cy="1656.9758" r="10.2336"
                                    gradientTransform="matrix(2.1528 2.7634 3.7588 -2.9283 -1415.0381 9451.9072)"
                                    gradientUnits="userSpaceOnUse">
                                    <stop offset="0.2247" style="stop-color:#D38D3C" />
                                    <stop offset="1" style="stop-color:#D38D3C;stop-opacity:0" />
                                </radialGradient>
                                <path style="fill:url(#SVGID_00000155832209708078965150000003448091086697147052_);" d="M1628.9,397.7c0-5.7,4.6-10.2,10.2-10.2
			h133.4c5.7,0,10.2,4.6,10.2,10.2v144.5c0,5.7-4.6,10.2-10.2,10.2h-133.4c-5.7,0-10.2-4.6-10.2-10.2V397.7z" />
                            </g>
                            <g>
                                <path class="st2" d="M1656.8,418c0-2.8-2.3-5.1-5.1-5.1c-2.8,0-5.1,2.3-5.1,5.1H1656.8z M1752.4,410.8c0-2.8-2.3-5.1-5.1-5.1
			c-2.8,0-5.1,2.3-5.1,5.1L1752.4,410.8z M1747.3,439.9h-5.1l0,0H1747.3z M1656.8,439.9V418h-10.2v21.9H1656.8z M1742.2,410.8
			l0,29.1l10.2,0l0-29.1L1742.2,410.8z M1699.5,485.9c-23,0-42.7-20.3-42.7-46.1h-10.2c0,30.8,23.6,56.3,52.9,56.3V485.9z
			 M1699.5,496.2c29.3,0,52.9-25.5,52.9-56.3h-10.2c0,25.7-19.7,46.1-42.7,46.1V496.2z" />
                            </g>
                            <g class="st3">
                                <path class="st4"
                                    d="M1707.8,444.2c0.1,0.1,0.2,0.1,0.2,0.1C1707.9,444.2,1707.8,444.2,1707.8,444.2z" />
                                <path class="st4" d="M1692.9,469.9c0-0.1-1.6-5.5-0.8-5.4c2.3,0.3,8.5-2,8.5-2c-0.2,0.6-0.7,1.1-0.7,1.1c2.4,0,7.1-5.6,7.1-5.6
			c4.1-0.1,4.9,2.2,4.9,2.2c0.8-5.5-3.3-6.4-3.3-6.4c-0.9-3.1-9.8-3-9.8-3s-2-10.5,9.1-6.7c-0.3-0.1-1-0.5-2.5-1.8c0,0,8.5,3,13,1.4
			c0,0-4.6-0.3-7-1.9c0,0,10.9,2,14.5,0c10,1.6,12.2-2.5,12.2-2.5c6.2-2.4,8.8-9.3,8.8-9.3s-4.1,7.4-12.2,6.7
			c-8.2-0.7-32.4-10-55.9,8.4c-23.5,18.4-13,51.8,3.9,56.2c0,0-4-11.7-2.4-16.9c0,0,4,25,19.1,23.2c0,0-9.6-5.1-11.1-22.1
			c0,0,9.5,26.6,28.8,24.4c0,0-12.5-5.4-18.2-18.8c0,0,15.6,25.1,47,16.5C1745.6,507.5,1709.1,506.6,1692.9,469.9z M1728,439.6
			c-3.8-0.2-8.8-0.8-16.1-2c0,0,0,0,0,0C1717.7,437.6,1723.2,438.9,1728,439.6z" />
                            </g>
                            <g>
                                <path class="st5" d="M1662.2,411.6c0-2.8-2.3-5.1-5.1-5.1c-2.8,0-5.1,2.3-5.1,5.1H1662.2z M1757.8,411.6c0-2.8-2.3-5.1-5.1-5.1
			c-2.8,0-5.1,2.3-5.1,5.1H1757.8z M1752.7,433.5h-5.1l0,0H1752.7z M1662.2,433.5v-21.9H1652v21.9H1662.2z M1747.6,411.6v21.9
			l10.2,0v-21.9H1747.6z M1704.9,479.5c-23,0-42.7-20.3-42.7-46.1H1652c0,30.8,23.6,56.3,52.9,56.3V479.5z M1704.9,489.8
			c29.3,0,52.9-25.5,52.9-56.3h-10.2c0,25.7-19.7,46.1-42.7,46.1V489.8z" />
                            </g>
                            <g>

                                <linearGradient id="SVGID_00000058574527513393991790000014246321465933883831_"
                                    gradientUnits="userSpaceOnUse" x1="1706.6582" y1="1075.8229" x2="1706.6582"
                                    y2="1011.7032" gradientTransform="matrix(1 0 0 -1 0 1483.7244)">
                                    <stop offset="0" style="stop-color:#F38362" />
                                    <stop offset="1" style="stop-color:#F38362;stop-opacity:0" />
                                </linearGradient>
                                <path style="fill:url(#SVGID_00000058574527513393991790000014246321465933883831_);"
                                    d="M1660.1,411.6c0-0.7-0.6-1.3-1.3-1.3
			c-0.7,0-1.3,0.6-1.3,1.3H1660.1z M1755.7,411.6c0-0.7-0.6-1.3-1.3-1.3c-0.7,0-1.3,0.6-1.3,1.3H1755.7z M1754.5,433.5h1.3l0,0
			H1754.5z M1660.1,433.5v-21.9h-2.6v21.9H1660.1z M1753.2,411.6v21.9h2.6v-21.9H1753.2z M1706.7,483.4c-25.4,0-46.5-22.3-46.5-49.9
			h-2.6c0,28.9,22.1,52.4,49.1,52.4V483.4z M1706.7,485.9c26.9,0,49.1-23.6,49.1-52.4h-2.6c0,27.6-21.2,49.9-46.5,49.9V485.9z" />

                                <linearGradient id="SVGID_00000068672982836431858500000001386303600173980548_"
                                    gradientUnits="userSpaceOnUse" x1="1671.1625" y1="1035.6089" x2="1735.762"
                                    y2="1035.6089" gradientTransform="matrix(1 0 0 -1 0 1483.7244)">
                                    <stop offset="0" style="stop-color:#F38362" />
                                    <stop offset="1" style="stop-color:#F38362;stop-opacity:0" />
                                </linearGradient>
                                <path style="fill:url(#SVGID_00000068672982836431858500000001386303600173980548_);"
                                    d="M1660.1,411.6c0-0.7-0.6-1.3-1.3-1.3
			c-0.7,0-1.3,0.6-1.3,1.3H1660.1z M1755.7,411.6c0-0.7-0.6-1.3-1.3-1.3c-0.7,0-1.3,0.6-1.3,1.3H1755.7z M1754.5,433.5h1.3l0,0
			H1754.5z M1660.1,433.5v-21.9h-2.6v21.9H1660.1z M1753.2,411.6v21.9h2.6v-21.9H1753.2z M1706.7,483.4c-25.4,0-46.5-22.3-46.5-49.9
			h-2.6c0,28.9,22.1,52.4,49.1,52.4V483.4z M1706.7,485.9c26.9,0,49.1-23.6,49.1-52.4h-2.6c0,27.6-21.2,49.9-46.5,49.9V485.9z" />
                            </g>

                            <linearGradient id="SVGID_00000045590936844570580970000003403758327453399168_"
                                gradientUnits="userSpaceOnUse" x1="1589.9335" y1="1158.6515" x2="1589.9335"
                                y2="953.0197" gradientTransform="matrix(1 0 0 -1 0 1483.7244)">
                                <stop offset="0" style="stop-color:#59C1FA" />
                                <stop offset="1" style="stop-color:#49A8FF" />
                            </linearGradient>
                            <path style="fill:url(#SVGID_00000045590936844570580970000003403758327453399168_);" d="M1508.7,325.1h162.5
		c5.7,0,10.2,4.6,10.2,10.2v185.2c0,5.7-4.6,10.2-10.2,10.2h-162.5c-5.7,0-10.2-4.6-10.2-10.2V335.3
		C1498.5,329.7,1503.1,325.1,1508.7,325.1z" />

                            <linearGradient id="SVGID_00000165956175104081434650000001643377529139776387_"
                                gradientUnits="userSpaceOnUse" x1="1498.4707" y1="1055.8356" x2="1516.3794"
                                y2="1055.8356" gradientTransform="matrix(1 0 0 -1 0 1483.7244)">
                                <stop offset="0" style="stop-color:#419CE0" />
                                <stop offset="1" style="stop-color:#449FEE;stop-opacity:0" />
                            </linearGradient>
                            <path style="fill:url(#SVGID_00000165956175104081434650000001643377529139776387_);" d="M1508.7,325.1h162.5
		c5.7,0,10.2,4.6,10.2,10.2v185.2c0,5.7-4.6,10.2-10.2,10.2h-162.5c-5.7,0-10.2-4.6-10.2-10.2V335.3
		C1498.5,329.7,1503.1,325.1,1508.7,325.1z" />

                            <linearGradient id="SVGID_00000102541504982467528610000005317768149566649244_"
                                gradientUnits="userSpaceOnUse" x1="1589.9335" y1="948.2231" x2="1589.9335" y2="992.9951"
                                gradientTransform="matrix(1 0 0 -1 0 1483.7244)">
                                <stop offset="0" style="stop-color:#4676F8" />
                                <stop offset="1" style="stop-color:#439AFF;stop-opacity:0" />
                            </linearGradient>
                            <path style="fill:url(#SVGID_00000102541504982467528610000005317768149566649244_);" d="M1508.7,325.1h162.5
		c5.7,0,10.2,4.6,10.2,10.2v185.2c0,5.7-4.6,10.2-10.2,10.2h-162.5c-5.7,0-10.2-4.6-10.2-10.2V335.3
		C1498.5,329.7,1503.1,325.1,1508.7,325.1z" />

                            <linearGradient id="SVGID_00000021804954767060424020000000685303347381852805_"
                                gradientUnits="userSpaceOnUse" x1="1589.9335" y1="1158.6515" x2="1589.9335"
                                y2="1136.5853" gradientTransform="matrix(1 0 0 -1 0 1483.7244)">
                                <stop offset="0.1594" style="stop-color:#61C9E8" />
                                <stop offset="1" style="stop-color:#61C9E8;stop-opacity:0" />
                            </linearGradient>
                            <path style="fill:url(#SVGID_00000021804954767060424020000000685303347381852805_);" d="M1508.7,325.1h162.5
		c5.7,0,10.2,4.6,10.2,10.2v185.2c0,5.7-4.6,10.2-10.2,10.2h-162.5c-5.7,0-10.2-4.6-10.2-10.2V335.3
		C1498.5,329.7,1503.1,325.1,1508.7,325.1z" />
                            <g>

                                <linearGradient id="SVGID_00000036957556078959330510000000113775951510510491_"
                                    gradientUnits="userSpaceOnUse" x1="1671.4828" y1="1145.1359" x2="1671.4828"
                                    y2="977.3073" gradientTransform="matrix(1 0 0 -1 0 1483.7244)">
                                    <stop offset="0" style="stop-color:#80E8FF" />
                                    <stop offset="0.7394" style="stop-color:#5BB8FF" />
                                    <stop offset="1" style="stop-color:#54AFFF" />
                                </linearGradient>

                                <path
                                    style="fill:none;stroke:url(#SVGID_00000036957556078959330510000000113775951510510491_);stroke-width:0.75;stroke-linecap:round;"
                                    d="
			M1671.5,335v179.1" />
                            </g>
                            <path class="st13" d="M1498.5,412.1v-22.7h182.9v22.7H1498.5z" />

                            <linearGradient id="SVGID_00000173159591564582303090000003945770454547031977_"
                                gradientUnits="userSpaceOnUse" x1="1498.4707" y1="1083.0186" x2="1517.339"
                                y2="1083.0186" gradientTransform="matrix(1 0 0 -1 0 1483.7244)">
                                <stop offset="0.1961" style="stop-color:#2A81CD" />
                                <stop offset="1" style="stop-color:#2A81CD;stop-opacity:0" />
                            </linearGradient>
                            <path style="fill:url(#SVGID_00000173159591564582303090000003945770454547031977_);"
                                d="M1498.5,412.1v-22.7h182.9v22.7H1498.5z" />

                            <linearGradient id="SVGID_00000073696610394481623350000008480431133396589970_"
                                gradientUnits="userSpaceOnUse" x1="1681.396" y1="1083.0186" x2="1663.4872"
                                y2="1083.0186" gradientTransform="matrix(1 0 0 -1 0 1483.7244)">
                                <stop offset="0" style="stop-color:#51A9F3" />
                                <stop offset="1" style="stop-color:#51A9F3;stop-opacity:0" />
                            </linearGradient>
                            <path style="fill:url(#SVGID_00000073696610394481623350000008480431133396589970_);"
                                d="M1498.5,412.1v-22.7h182.9v22.7H1498.5z" />

                            <linearGradient id="SVGID_00000124124269283648797200000004448534148379328699_"
                                gradientUnits="userSpaceOnUse" x1="1681.396" y1="1083.0186" x2="1673.0812"
                                y2="1083.0186" gradientTransform="matrix(1 0 0 -1 0 1483.7244)">
                                <stop offset="0" style="stop-color:#3C97EE" />
                                <stop offset="1" style="stop-color:#3C97EE;stop-opacity:0" />
                            </linearGradient>
                            <path style="fill:url(#SVGID_00000124124269283648797200000004448534148379328699_);"
                                d="M1498.5,412.1v-22.7h182.9v22.7H1498.5z" />
                            <path class="st17" d="M1498.5,459.7V437h182.9v22.7H1498.5z" />

                            <linearGradient id="SVGID_00000176008779933615546070000015134513844309337257_"
                                gradientUnits="userSpaceOnUse" x1="1498.4707" y1="1035.3684" x2="1517.339"
                                y2="1035.3684" gradientTransform="matrix(1 0 0 -1 0 1483.7244)">
                                <stop offset="0.1961" style="stop-color:#2A81CD" />
                                <stop offset="1" style="stop-color:#2A81CD;stop-opacity:0" />
                            </linearGradient>
                            <path style="fill:url(#SVGID_00000176008779933615546070000015134513844309337257_);"
                                d="M1498.5,459.7V437h182.9v22.7H1498.5z" />

                            <linearGradient id="SVGID_00000134930091141973234850000011055856868403941817_"
                                gradientUnits="userSpaceOnUse" x1="1681.396" y1="1035.3684" x2="1663.4872"
                                y2="1035.3684" gradientTransform="matrix(1 0 0 -1 0 1483.7244)">
                                <stop offset="0" style="stop-color:#51A9F3" />
                                <stop offset="1" style="stop-color:#51A9F3;stop-opacity:0" />
                            </linearGradient>
                            <path style="fill:url(#SVGID_00000134930091141973234850000011055856868403941817_);"
                                d="M1498.5,459.7V437h182.9v22.7H1498.5z" />

                            <linearGradient id="SVGID_00000093895365091318183530000004619226637635589782_"
                                gradientUnits="userSpaceOnUse" x1="1681.396" y1="1035.3684" x2="1673.0812"
                                y2="1035.3684" gradientTransform="matrix(1 0 0 -1 0 1483.7244)">
                                <stop offset="0" style="stop-color:#3C97EE" />
                                <stop offset="1" style="stop-color:#3C97EE;stop-opacity:0" />
                            </linearGradient>
                            <path style="fill:url(#SVGID_00000093895365091318183530000004619226637635589782_);"
                                d="M1498.5,459.7V437h182.9v22.7H1498.5z" />
                            <g class="st21">
                                <path class="st22"
                                    d="M1591.8,419.1c0.1,0.1,0.2,0.1,0.2,0.1C1592,419.2,1591.9,419.1,1591.8,419.1z" />
                                <path class="st22" d="M1576.9,444.9c0-0.1-1.6-5.5-0.8-5.4c2.3,0.3,8.5-2,8.5-2c-0.2,0.6-0.7,1.1-0.7,1.1c2.4,0,7.1-5.6,7.1-5.6
			c4.1-0.1,4.9,2.2,4.9,2.2c0.8-5.5-3.3-6.4-3.3-6.4c-0.9-3.1-9.8-3-9.8-3s-2-10.5,9.1-6.7c-0.3-0.1-1-0.5-2.5-1.8c0,0,8.5,3,13,1.4
			c0,0-4.6-0.3-7-1.9c0,0,10.9,2,14.5,0c10,1.6,12.2-2.5,12.2-2.5c6.2-2.4,8.8-9.3,8.8-9.3s-4.1,7.4-12.2,6.7
			c-8.2-0.7-32.4-10-55.9,8.4c-23.5,18.4-13,51.8,3.9,56.2c0,0-4-11.7-2.4-16.9c0,0,4,25,19.1,23.2c0,0-9.6-5.1-11.1-22.1
			c0,0,9.5,26.6,28.8,24.4c0,0-12.5-5.4-18.2-18.8c0,0,15.6,25.1,47,16.5C1629.7,482.5,1593.2,481.5,1576.9,444.9z M1612.1,414.6
			c-3.8-0.2-8.8-0.8-16.1-2c0,0,0,0,0,0C1601.7,412.6,1607.2,413.9,1612.1,414.6z" />
                            </g>
                            <path class="st23" d="M1498.5,507.4v-22.7h182.9v22.7H1498.5z" />

                            <linearGradient id="SVGID_00000123422791202348092000000002134956438397012127_"
                                gradientUnits="userSpaceOnUse" x1="1498.4707" y1="987.7187" x2="1517.339" y2="987.7187"
                                gradientTransform="matrix(1 0 0 -1 0 1483.7244)">
                                <stop offset="0.1961" style="stop-color:#2A81CD" />
                                <stop offset="1" style="stop-color:#2A81CD;stop-opacity:0" />
                            </linearGradient>
                            <path style="fill:url(#SVGID_00000123422791202348092000000002134956438397012127_);"
                                d="M1498.5,507.4v-22.7h182.9v22.7H1498.5z" />

                            <linearGradient id="SVGID_00000082328700704536190490000006166740990933587619_"
                                gradientUnits="userSpaceOnUse" x1="1681.396" y1="987.7187" x2="1663.4872" y2="987.7187"
                                gradientTransform="matrix(1 0 0 -1 0 1483.7244)">
                                <stop offset="0" style="stop-color:#51A9F3" />
                                <stop offset="1" style="stop-color:#51A9F3;stop-opacity:0" />
                            </linearGradient>
                            <path style="fill:url(#SVGID_00000082328700704536190490000006166740990933587619_);"
                                d="M1498.5,507.4v-22.7h182.9v22.7H1498.5z" />

                            <linearGradient id="SVGID_00000156549288516168018930000002914863672914509699_"
                                gradientUnits="userSpaceOnUse" x1="1681.396" y1="987.7187" x2="1673.0812" y2="987.7187"
                                gradientTransform="matrix(1 0 0 -1 0 1483.7244)">
                                <stop offset="0" style="stop-color:#3C97EE" />
                                <stop offset="1" style="stop-color:#3C97EE;stop-opacity:0" />
                            </linearGradient>
                            <path style="fill:url(#SVGID_00000156549288516168018930000002914863672914509699_);"
                                d="M1498.5,507.4v-22.7h182.9v22.7H1498.5z" />
                            <g>

                                <linearGradient id="SVGID_00000070838180487677013780000000274030125871380352_"
                                    gradientUnits="userSpaceOnUse" x1="1774.7106" y1="1086.3101" x2="1774.7106"
                                    y2="959.1888" gradientTransform="matrix(1 0 0 -1 0 1483.7244)">
                                    <stop offset="0" style="stop-color:#FFD262" />
                                    <stop offset="1" style="stop-color:#FFB84A" />
                                </linearGradient>

                                <path
                                    style="fill:none;stroke:url(#SVGID_00000070838180487677013780000000274030125871380352_);stroke-width:0.75;stroke-linecap:round;"
                                    d="
			M1774.7,396.8l0,146.2" />
                            </g>
                            <g>
                                <path class="st28" d="M1636.3,330.8v32" />
                            </g>
                            <g>
                                <path class="st28" d="M1533.3,330.8v32" />
                            </g>
                            <g>

                                <radialGradient id="SVGID_00000111168146524061348960000014055569447307196578_"
                                    cx="-2039.1781" cy="1400.9255" r="10.2336"
                                    gradientTransform="matrix(2.4688 8.0625 9.5043 -2.9102 -6715.9604 20792.7734)"
                                    gradientUnits="userSpaceOnUse">
                                    <stop offset="0" style="stop-color:#2C94E3" />
                                    <stop offset="1" style="stop-color:#2C9CEB" />
                                </radialGradient>
                                <path style="fill:url(#SVGID_00000111168146524061348960000014055569447307196578_);" d="M1636.5,357.4c0,2.8,2.3,5.1,5.1,5.1
			c2.8,0,5.1-2.3,5.1-5.1H1636.5z M1533.2,357.4c0,2.8,2.3,5.1,5.1,5.1s5.1-2.3,5.1-5.1H1533.2z M1636.5,320.9v36.5h10.2v-36.5
			H1636.5z M1543.4,357.4v-36.5h-10.2v36.5H1543.4z M1589.9,274.9c25.5,0,46.5,20.7,46.5,46.1h10.2c0-31.1-25.7-56.3-56.8-56.3
			V274.9z M1589.9,264.6c-31,0-56.8,25.1-56.8,56.3h10.2c0-25.4,21-46.1,46.5-46.1V264.6z" />
                            </g>
                            <g>

                                <linearGradient id="SVGID_00000135650493374756661610000016474223054408365718_"
                                    gradientUnits="userSpaceOnUse" x1="1590.8131" y1="1121.2355" x2="1590.8131"
                                    y2="1174.9613" gradientTransform="matrix(1 0 0 -1 0 1483.7244)">
                                    <stop offset="0" style="stop-color:#53A9F2" />
                                    <stop offset="1" style="stop-color:#53A9F2;stop-opacity:0" />
                                </linearGradient>
                                <path style="fill:url(#SVGID_00000135650493374756661610000016474223054408365718_);" d="M1642.1,357.4c0,0.7,0.6,1.3,1.3,1.3
			c0.7,0,1.3-0.6,1.3-1.3H1642.1z M1537,357.4c0,0.7,0.6,1.3,1.3,1.3s1.3-0.6,1.3-1.3H1537z M1642.1,320.9v36.5h2.6v-36.5H1642.1z
			 M1539.6,357.4v-36.5h-2.6v36.5H1539.6z M1590.8,271c28.1,0,51.2,22.4,51.2,49.9h2.6c0-29-24.4-52.4-53.8-52.4V271z M1590.8,268.5
			c-29.4,0-53.8,23.4-53.8,52.4h2.6c0-27.5,23.2-49.9,51.2-49.9V268.5z" />

                                <linearGradient id="SVGID_00000034090030972898849650000017076273509053831349_"
                                    gradientUnits="userSpaceOnUse" x1="1630.7389" y1="1201.734" x2="1610.5909"
                                    y2="1177.4292" gradientTransform="matrix(1 0 0 -1 0 1483.7244)">
                                    <stop offset="0" style="stop-color:#61B2F2" />
                                    <stop offset="1" style="stop-color:#61B2F2;stop-opacity:0" />
                                </linearGradient>
                                <path style="fill:url(#SVGID_00000034090030972898849650000017076273509053831349_);" d="M1642.1,357.4c0,0.7,0.6,1.3,1.3,1.3
			c0.7,0,1.3-0.6,1.3-1.3H1642.1z M1537,357.4c0,0.7,0.6,1.3,1.3,1.3s1.3-0.6,1.3-1.3H1537z M1642.1,320.9v36.5h2.6v-36.5H1642.1z
			 M1539.6,357.4v-36.5h-2.6v36.5H1539.6z M1590.8,271c28.1,0,51.2,22.4,51.2,49.9h2.6c0-29-24.4-52.4-53.8-52.4V271z M1590.8,268.5
			c-29.4,0-53.8,23.4-53.8,52.4h2.6c0-27.5,23.2-49.9,51.2-49.9V268.5z" />
                            </g>
                        </g>
                        <g id="PLANE">

                            <linearGradient id="SVGID_00000097476706812405416840000002853052082429623228_"
                                gradientUnits="userSpaceOnUse" x1="-421.462" y1="-1021.5199" x2="-424.0977"
                                y2="-1039.871"
                                gradientTransform="matrix(0.8201 -0.5722 -0.5722 -0.8201 202.4337 80.8793)">
                                <stop offset="0" style="stop-color:#626A78" />
                                <stop offset="0.5617" style="stop-color:#818094" />
                            </linearGradient>
                            <path style="fill:url(#SVGID_00000097476706812405416840000002853052082429623228_);" d="M428.9,1168.7l22.9-16
		c4.1-2.9,9.8-1.9,12.7,2.3l0.1,0.1c2.9,4.1,1.9,9.8-2.3,12.7l-22.9,16c-4.1,2.9-9.8,1.9-12.7-2.3l-0.1-0.1
		C423.8,1177.2,424.8,1171.5,428.9,1168.7z" />

                            <linearGradient id="SVGID_00000042725999054701376520000011886593343199803266_"
                                gradientUnits="userSpaceOnUse" x1="-423.3697" y1="-1041.0051" x2="-423.182"
                                y2="-1037.6411"
                                gradientTransform="matrix(0.8201 -0.5722 -0.5722 -0.8201 202.4337 80.8793)">
                                <stop offset="0" style="stop-color:#75708A" />
                                <stop offset="1" style="stop-color:#75708A;stop-opacity:0" />
                            </linearGradient>
                            <path style="fill:url(#SVGID_00000042725999054701376520000011886593343199803266_);" d="M428.9,1168.7l22.9-16
		c4.1-2.9,9.8-1.9,12.7,2.3l0.1,0.1c2.9,4.1,1.9,9.8-2.3,12.7l-22.9,16c-4.1,2.9-9.8,1.9-12.7-2.3l-0.1-0.1
		C423.8,1177.2,424.8,1171.5,428.9,1168.7z" />

                            <radialGradient id="SVGID_00000018950072818263446340000012980638699903355837_"
                                cx="-3783.8479" cy="2879.8667" r="10.789"
                                gradientTransform="matrix(-0.8546 0.6047 0.648 0.9159 -4635.3462 805.639)"
                                gradientUnits="userSpaceOnUse">
                                <stop offset="0.1037" style="stop-color:#AEADB3" />
                                <stop offset="1" style="stop-color:#AEADB3;stop-opacity:0" />
                            </radialGradient>
                            <path style="fill:url(#SVGID_00000018950072818263446340000012980638699903355837_);" d="M428.9,1168.7l22.9-16
		c4.1-2.9,9.8-1.9,12.7,2.3l0.1,0.1c2.9,4.1,1.9,9.8-2.3,12.7l-22.9,16c-4.1,2.9-9.8,1.9-12.7-2.3l-0.1-0.1
		C423.8,1177.2,424.8,1171.5,428.9,1168.7z" />

                            <linearGradient id="SVGID_00000132790515223238270990000014838746844513025725_"
                                gradientUnits="userSpaceOnUse" x1="-419.6988" y1="-922.7038" x2="-422.3356"
                                y2="-941.0552"
                                gradientTransform="matrix(0.8201 -0.5722 -0.5722 -0.8201 206.1492 76.7164)">
                                <stop offset="0" style="stop-color:#626A78" />
                                <stop offset="0.5617" style="stop-color:#818094" />
                            </linearGradient>
                            <path style="fill:url(#SVGID_00000132790515223238270990000014838746844513025725_);" d="M377.5,1082.5l22.9-16
		c4.1-2.9,9.8-1.9,12.7,2.3l0.1,0.1c2.9,4.1,1.9,9.8-2.3,12.7l-22.9,16c-4.1,2.9-9.8,1.9-12.7-2.3l-0.1-0.1
		C372.4,1091,373.4,1085.3,377.5,1082.5z" />

                            <linearGradient id="SVGID_00000166669422644190967150000008260478581480000941_"
                                gradientUnits="userSpaceOnUse" x1="-421.6104" y1="-942.187" x2="-421.4215"
                                y2="-938.8238"
                                gradientTransform="matrix(0.8201 -0.5722 -0.5722 -0.8201 206.1492 76.7164)">
                                <stop offset="0" style="stop-color:#75708A" />
                                <stop offset="1" style="stop-color:#75708A;stop-opacity:0" />
                            </linearGradient>
                            <path style="fill:url(#SVGID_00000166669422644190967150000008260478581480000941_);" d="M377.5,1082.5l22.9-16
		c4.1-2.9,9.8-1.9,12.7,2.3l0.1,0.1c2.9,4.1,1.9,9.8-2.3,12.7l-22.9,16c-4.1,2.9-9.8,1.9-12.7-2.3l-0.1-0.1
		C372.4,1091,373.4,1085.3,377.5,1082.5z" />

                            <radialGradient id="SVGID_00000000209853693401738420000014435213243219606975_"
                                cx="-3366.8103" cy="2428.6702" r="10.789"
                                gradientTransform="matrix(-1.0867 0.8224 0.8813 1.1646 -5380.6895 1006.5106)"
                                gradientUnits="userSpaceOnUse">
                                <stop offset="0.1037" style="stop-color:#AEADB3" />
                                <stop offset="1" style="stop-color:#AEADB3;stop-opacity:0" />
                            </radialGradient>
                            <path style="fill:url(#SVGID_00000000209853693401738420000014435213243219606975_);" d="M377.5,1082.5l22.9-16
		c4.1-2.9,9.8-1.9,12.7,2.3l0.1,0.1c2.9,4.1,1.9,9.8-2.3,12.7l-22.9,16c-4.1,2.9-9.8,1.9-12.7-2.3l-0.1-0.1
		C372.4,1091,373.4,1085.3,377.5,1082.5z" />
                            <g>

                                <linearGradient id="SVGID_00000083791382047616183150000000336702356687462038_"
                                    gradientUnits="userSpaceOnUse" x1="399.0291" y1="389.4824" x2="300.3741"
                                    y2="425.5682" gradientTransform="matrix(1 0 0 -1 0 1483.7244)">
                                    <stop offset="0" style="stop-color:#328CC4" />
                                    <stop offset="1" style="stop-color:#34A5E4" />
                                </linearGradient>
                                <path style="fill:url(#SVGID_00000083791382047616183150000000336702356687462038_);" d="M409.5,1132.4l72.8-42.1l-145.8-31.7
			c-4.4-1-9.1-0.2-12.9,2c-12.7,7.3-12,26,1.4,32.3L409.5,1132.4z" />

                                <linearGradient id="SVGID_00000154392855399167900470000013995107268710043291_"
                                    gradientUnits="userSpaceOnUse" x1="400.8628" y1="412.1255" x2="399.854"
                                    y2="407.6443" gradientTransform="matrix(1 0 0 -1 0 1483.7244)">
                                    <stop offset="0" style="stop-color:#49AEE8" />
                                    <stop offset="1" style="stop-color:#49AEE8;stop-opacity:0" />
                                </linearGradient>
                                <path style="fill:url(#SVGID_00000154392855399167900470000013995107268710043291_);" d="M409.5,1132.4l72.8-42.1l-145.8-31.7
			c-4.4-1-9.1-0.2-12.9,2c-12.7,7.3-12,26,1.4,32.3L409.5,1132.4z" />
                            </g>
                            <g>
                                <path class="st40" d="M264.9,1155.2l5.2,9.1c9.9,17.3,27.4,28.7,47.1,31.1c13.5,1.6,27.1-1.2,38.8-8l169.6-97.9
			c16.9-9.8,22.5-31.9,12.4-49.5c-10.1-17.6-32.2-23.8-49.1-14L264.9,1155.2z" />
                            </g>

                            <radialGradient id="SVGID_00000140003205513237036470000015032499795139614355_"
                                cx="-2081.0417" cy="884.6451" r="10.789"
                                gradientTransform="matrix(20.3342 -13.5955 -7.0418 -10.5321 48864.3086 -17798.2402)"
                                gradientUnits="userSpaceOnUse">
                                <stop offset="0.8683" style="stop-color:#FFFFFF;stop-opacity:0" />
                                <stop offset="1" style="stop-color:#FFFFFF" />
                            </radialGradient>
                            <path style="fill:url(#SVGID_00000140003205513237036470000015032499795139614355_);" d="M264.9,1155.2l5.2,9.1
		c9.9,17.3,27.4,28.7,47.1,31.1c13.5,1.6,27.1-1.2,38.8-8l169.6-97.9c16.9-9.8,22.5-31.9,12.4-49.5c-10.1-17.6-32.2-23.8-49.1-14
		L264.9,1155.2z" />

                            <linearGradient id="SVGID_00000081628934895860369490000016452403518255001513_"
                                gradientUnits="userSpaceOnUse" x1="387.6078" y1="409.8206" x2="395.2605" y2="396.7466"
                                gradientTransform="matrix(1 0 0 -1 0 1483.7244)">
                                <stop offset="0" style="stop-color:#B6B6B7" />
                                <stop offset="1" style="stop-color:#B6B6B7;stop-opacity:0" />
                            </linearGradient>
                            <path style="fill:url(#SVGID_00000081628934895860369490000016452403518255001513_);" d="M264.9,1155.2l5.2,9.1
		c9.9,17.3,27.4,28.7,47.1,31.1c13.5,1.6,27.1-1.2,38.8-8l169.6-97.9c16.9-9.8,22.5-31.9,12.4-49.5c-10.1-17.6-32.2-23.8-49.1-14
		L264.9,1155.2z" />

                            <radialGradient id="SVGID_00000103955470483245454950000004156440673021396128_"
                                cx="-2231.9519" cy="3017.3938" r="10.789"
                                gradientTransform="matrix(-2.375 4.9688 1.1804 0.5642 -8460.7207 10546.8623)"
                                gradientUnits="userSpaceOnUse">
                                <stop offset="8.671501e-02" style="stop-color:#7F81A3" />
                                <stop offset="1" style="stop-color:#7F81A3;stop-opacity:0" />
                            </radialGradient>
                            <path style="fill:url(#SVGID_00000103955470483245454950000004156440673021396128_);" d="M264.9,1155.2l5.2,9.1
		c9.9,17.3,27.4,28.7,47.1,31.1c13.5,1.6,27.1-1.2,38.8-8l169.6-97.9c16.9-9.8,22.5-31.9,12.4-49.5c-10.1-17.6-32.2-23.8-49.1-14
		L264.9,1155.2z" />

                            <radialGradient id="SVGID_00000071544224618492434840000011460583369477770657_"
                                cx="-1592.9966" cy="588.0701" r="10.789"
                                gradientTransform="matrix(4.3125 -9.374970e-02 -3.601941e-02 -1.6569 7157.8384 1979.5128)"
                                gradientUnits="userSpaceOnUse">
                                <stop offset="0" style="stop-color:#C2C2C8" />
                                <stop offset="1" style="stop-color:#C2C2C8;stop-opacity:0" />
                            </radialGradient>
                            <path style="fill:url(#SVGID_00000071544224618492434840000011460583369477770657_);" d="M264.9,1155.2l5.2,9.1
		c9.9,17.3,27.4,28.7,47.1,31.1c13.5,1.6,27.1-1.2,38.8-8l169.6-97.9c16.9-9.8,22.5-31.9,12.4-49.5c-10.1-17.6-32.2-23.8-49.1-14
		L264.9,1155.2z" />

                            <linearGradient id="SVGID_00000089570920315070619870000016773032312536060288_"
                                gradientUnits="userSpaceOnUse" x1="491.5094" y1="425.2008" x2="545.8235" y2="458.0763"
                                gradientTransform="matrix(1 0 0 -1 0 1483.7244)">
                                <stop offset="0" style="stop-color:#83F6FF" />
                                <stop offset="0.1004" style="stop-color:#95E9F7" />
                            </linearGradient>
                            <path
                                style="fill-rule:evenodd;clip-rule:evenodd;fill:url(#SVGID_00000089570920315070619870000016773032312536060288_);"
                                d="
		M527.3,1028.1l-32.5,18.7c-3.9,2.2-5.2,7-2.9,10.8c2.2,3.8,7,5.1,10.8,2.9l35.4-20.5c0,0,0,0,0,0
		C535.3,1035.1,531.6,1031.1,527.3,1028.1z" />

                            <linearGradient id="SVGID_00000045612513976239528110000011387166888808648846_"
                                gradientUnits="userSpaceOnUse" x1="508.9935" y1="445.3124" x2="510.1738" y2="443.2894"
                                gradientTransform="matrix(1 0 0 -1 0 1483.7244)">
                                <stop offset="0" style="stop-color:#71C9DE" />
                                <stop offset="1" style="stop-color:#71C9DE;stop-opacity:0" />
                            </linearGradient>
                            <path
                                style="fill-rule:evenodd;clip-rule:evenodd;fill:url(#SVGID_00000045612513976239528110000011387166888808648846_);"
                                d="
		M527.3,1028.1l-32.5,18.7c-3.9,2.2-5.2,7-2.9,10.8c2.2,3.8,7,5.1,10.8,2.9l35.4-20.5c0,0,0,0,0,0
		C535.3,1035.1,531.6,1031.1,527.3,1028.1z" />

                            <linearGradient id="SVGID_00000127737024840474687700000009475761085440479678_"
                                gradientUnits="userSpaceOnUse" x1="517.611" y1="430.5201" x2="514.5771" y2="435.7461"
                                gradientTransform="matrix(1 0 0 -1 0 1483.7244)">
                                <stop offset="0" style="stop-color:#71C9DE" />
                                <stop offset="1" style="stop-color:#71C9DE;stop-opacity:0" />
                            </linearGradient>
                            <path
                                style="fill-rule:evenodd;clip-rule:evenodd;fill:url(#SVGID_00000127737024840474687700000009475761085440479678_);"
                                d="
		M527.3,1028.1l-32.5,18.7c-3.9,2.2-5.2,7-2.9,10.8c2.2,3.8,7,5.1,10.8,2.9l35.4-20.5c0,0,0,0,0,0
		C535.3,1035.1,531.6,1031.1,527.3,1028.1z" />
                            <g>

                                <linearGradient id="SVGID_00000181767370110448272250000002891192306794843828_"
                                    gradientUnits="userSpaceOnUse" x1="295.3795" y1="339.7757" x2="262.2182"
                                    y2="388.1736" gradientTransform="matrix(1 0 0 -1 0 1483.7244)">
                                    <stop offset="7.224770e-02" style="stop-color:#399BDA" />
                                    <stop offset="1" style="stop-color:#3BA9F1" />
                                </linearGradient>
                                <path style="fill:url(#SVGID_00000181767370110448272250000002891192306794843828_);" d="M319.6,1123.7l-31.7-17.7
			c-13.6-7.4-30.1-7.3-43.6,0.4c-3.1,1.8-4.2,5.8-2.4,9l23,39.8L319.6,1123.7z" />

                                <linearGradient id="SVGID_00000136381146451716590980000007221452181505962116_"
                                    gradientUnits="userSpaceOnUse" x1="252.448" y1="351.3815" x2="257.0069"
                                    y2="354.0475" gradientTransform="matrix(1 0 0 -1 0 1483.7244)">
                                    <stop offset="0" style="stop-color:#4685C2" />
                                    <stop offset="1" style="stop-color:#4685C2;stop-opacity:0" />
                                </linearGradient>
                                <path style="fill:url(#SVGID_00000136381146451716590980000007221452181505962116_);" d="M319.6,1123.7l-31.7-17.7
			c-13.6-7.4-30.1-7.3-43.6,0.4c-3.1,1.8-4.2,5.8-2.4,9l23,39.8L319.6,1123.7z" />
                            </g>
                            <g>

                                <linearGradient id="SVGID_00000106832446056747017510000013442666953522725774_"
                                    gradientUnits="userSpaceOnUse" x1="444.999" y1="394.0314" x2="399.8199"
                                    y2="246.9046" gradientTransform="matrix(1 0 0 -1 0 1483.7244)">
                                    <stop offset="0" style="stop-color:#2E83C4" />
                                    <stop offset="1" style="stop-color:#32AEF4" />
                                </linearGradient>
                                <path style="fill:url(#SVGID_00000106832446056747017510000013442666953522725774_);" d="M410.2,1119.9l44.8-25.9
			c7.8-4.5,17,2.9,14.3,11.5l-37.7,117.8c-1.4,4.3-4.3,8-8.2,10.2c-12.7,7.3-28.6-2.7-27.3-17.4l7.6-86.1
			C404.1,1125.9,406.5,1122,410.2,1119.9z" />
                            </g>

                            <linearGradient id="SVGID_00000154425923813950916550000014014415253935547837_"
                                gradientUnits="userSpaceOnUse" x1="451.155" y1="314.4406" x2="442.649" y2="317.276"
                                gradientTransform="matrix(1 0 0 -1 0 1483.7244)">
                                <stop offset="0" style="stop-color:#41B6FD" />
                                <stop offset="1" style="stop-color:#41B6FD;stop-opacity:0" />
                            </linearGradient>
                            <path style="fill:url(#SVGID_00000154425923813950916550000014014415253935547837_);" d="M410.2,1119.9l44.8-25.9
		c7.8-4.5,17,2.9,14.3,11.5l-37.7,117.8c-1.4,4.3-4.3,8-8.2,10.2c-12.7,7.3-28.6-2.7-27.3-17.4l7.6-86.1
		C404.1,1125.9,406.5,1122,410.2,1119.9z" />
                            <g>

                                <linearGradient id="SVGID_00000108290435421396000380000003440235723149548946_"
                                    gradientUnits="userSpaceOnUse" x1="464.6824" y1="384.1906" x2="424.3287"
                                    y2="261.3891" gradientTransform="matrix(1 0 0 -1 0 1483.7244)">
                                    <stop offset="0" style="stop-color:#62A8E8" />
                                    <stop offset="1" style="stop-color:#66C9FF" />
                                </linearGradient>

                                <path
                                    style="fill:none;stroke:url(#SVGID_00000108290435421396000380000003440235723149548946_);stroke-width:0.25;stroke-linecap:round;"
                                    d="
			M462.2,1098.3c1.3,0.8,3.8,2.6,2.2,7.8c-1.6,5.1-24.4,77.4-35.9,113.5c-0.9,3-4.7,10.3-9.9,10.3" />
                            </g>
                        </g>
                        <g id="TRUCK-2">
                            <g>
                                <path class="st53"
                                    d="M971.7,592.7l-25.5,8.5c-10.5,3.5-17.4,12.7-17.4,26.3h55.1v-26.1C983.8,595,977.6,590.6,971.7,592.7z" />
                            </g>
                            <g>

                                <linearGradient id="SVGID_00000093138043680205904570000010845307765859465866_"
                                    gradientUnits="userSpaceOnUse" x1="1148.9789" y1="830.8647" x2="992.9688"
                                    y2="830.8647" gradientTransform="matrix(1 0 0 -1 0 1483.7244)">
                                    <stop offset="0" style="stop-color:#E1DDE4" />
                                    <stop offset="1" style="stop-color:#DEDBE2" />
                                </linearGradient>
                                <path style="fill:url(#SVGID_00000093138043680205904570000010845307765859465866_);" d="M1130.6,570.3h-119.3
			c-10.1,0-18.4,8.3-18.4,18.4v146.8h156V588.6C1149,578.5,1140.8,570.3,1130.6,570.3z" />
                            </g>
                            <g>

                                <linearGradient id="SVGID_00000161630175936282368830000013819820469917068454_"
                                    gradientUnits="userSpaceOnUse" x1="892.0212" y1="803.3336" x2="986.9175"
                                    y2="803.3336" gradientTransform="matrix(1 0 0 -1 0 1483.7244)">
                                    <stop offset="0" style="stop-color:#3DCF77" />
                                    <stop offset="1" style="stop-color:#3CCC76" />
                                </linearGradient>
                                <path style="fill:url(#SVGID_00000161630175936282368830000013819820469917068454_);" d="M983.8,625.3h-58.7c-3.5,0-6.7,1.9-8.3,5
			l-22,44.1c-1.8,3.9-2.9,8.1-2.9,12.3v39.5v9.2h91.8V625.3z" />

                                <linearGradient id="SVGID_00000148639639388741299240000005960171201966134172_"
                                    gradientUnits="userSpaceOnUse" x1="937.9065" y1="858.3959" x2="937.9065"
                                    y2="815.9163" gradientTransform="matrix(1 0 0 -1 0 1483.7244)">
                                    <stop offset="0" style="stop-color:#50EC8F" />
                                    <stop offset="1" style="stop-color:#50EC8F;stop-opacity:0" />
                                </linearGradient>
                                <path style="fill:url(#SVGID_00000148639639388741299240000005960171201966134172_);" d="M983.8,625.3h-58.7c-3.5,0-6.7,1.9-8.3,5
			l-22,44.1c-1.8,3.9-2.9,8.1-2.9,12.3v39.5v9.2h91.8V625.3z" />
                            </g>
                            <g>

                                <linearGradient id="SVGID_00000087386171613795802910000007735335227915864487_"
                                    gradientUnits="userSpaceOnUse" x1="916.8224" y1="820.7726" x2="916.8224"
                                    y2="792.3133" gradientTransform="matrix(1 0 0 -1 0 1483.7244)">
                                    <stop offset="0" style="stop-color:#227148" />
                                    <stop offset="1" style="stop-color:#25764E" />
                                </linearGradient>
                                <path
                                    style="fill-rule:evenodd;clip-rule:evenodd;fill:url(#SVGID_00000087386171613795802910000007735335227915864487_);"
                                    d="
			M907.5,677.2c0-2.7,0.6-8.7,4.5-11.9c2.5-2.1,6.5-2.5,9.7-2.3c2.7,0.2,4.3,2.6,4.3,5.3v8.9v8.9c0,2.6-1.6,5-4.3,5.3
			c-3.2,0.3-7.2-0.2-9.7-2.3C908.2,685.9,907.6,679.9,907.5,677.2z" />
                            </g>
                            <g>

                                <linearGradient id="SVGID_00000105427406148476233310000005439326345325497511_"
                                    gradientUnits="userSpaceOnUse" x1="933.4714" y1="832.6981" x2="897.05" y2="810.329"
                                    gradientTransform="matrix(1 0 0 -1 0 1483.7244)">
                                    <stop offset="0" style="stop-color:#249FEB" />
                                    <stop offset="1" style="stop-color:#47D6FF" />
                                </linearGradient>
                                <path style="fill:url(#SVGID_00000105427406148476233310000005439326345325497511_);" d="M928.6,634.4h-13.8l-20,40.1
			c-0.9,1.8-1.7,3.9-2.1,5.9h36c5,0,9.2-4.1,9.2-9.2v-27.5C937.9,638.6,933.7,634.4,928.6,634.4z" />
                            </g>
                            <g>

                                <linearGradient id="SVGID_00000057855247597967801910000004997666189454091392_"
                                    gradientUnits="userSpaceOnUse" x1="974.6152" y1="826.2767" x2="947.0831"
                                    y2="826.2758" gradientTransform="matrix(1 0 0 -1 0 1483.7244)">
                                    <stop offset="0.3656" style="stop-color:#38AFE3" />
                                    <stop offset="1" style="stop-color:#53ECFF" />
                                </linearGradient>
                                <path style="fill:url(#SVGID_00000057855247597967801910000004997666189454091392_);" d="M965.5,634.5h-9.3c-5,0-9.1,4.1-9.1,9.2
			v27.6c0,5,4.1,9.2,9.1,9.2h9.3c5,0,9.1-4.1,9.1-9.2v-27.6C974.6,638.6,970.5,634.5,965.5,634.5z" />
                            </g>
                            <g>

                                <linearGradient id="SVGID_00000107567119734843565140000005445080085416077979_"
                                    gradientUnits="userSpaceOnUse" x1="1011.2715" y1="835.4533" x2="1043.4142"
                                    y2="835.4533" gradientTransform="matrix(1 0 0 -1 0 1483.7244)">
                                    <stop offset="0" style="stop-color:#D3CDD8" />
                                    <stop offset="1" style="stop-color:#C6C0CB" />
                                </linearGradient>
                                <path style="fill:url(#SVGID_00000107567119734843565140000005445080085416077979_);"
                                    d="M1033.6,707.9h-17.1
			c-2.8,0-5.2-2.3-5.2-5.2V593.9c0-2.8,2.3-5.2,5.2-5.2h17.1c2.8,0,5.2,2.3,5.2,5.2v108.8C1038.9,705.6,1036.5,707.9,1033.6,707.9z" />

                                <linearGradient id="SVGID_00000122681663591246821790000017729082206582804126_"
                                    gradientUnits="userSpaceOnUse" x1="1011.3229" y1="835.4533" x2="1017.89"
                                    y2="835.4533" gradientTransform="matrix(1 0 0 -1 0 1483.7244)">
                                    <stop offset="0" style="stop-color:#DCD8E0" />
                                    <stop offset="1" style="stop-color:#DCD8E0;stop-opacity:0" />
                                </linearGradient>
                                <path style="fill:url(#SVGID_00000122681663591246821790000017729082206582804126_);"
                                    d="M1033.6,707.9h-17.1
			c-2.8,0-5.2-2.3-5.2-5.2V593.9c0-2.8,2.3-5.2,5.2-5.2h17.1c2.8,0,5.2,2.3,5.2,5.2v108.8C1038.9,705.6,1036.5,707.9,1033.6,707.9z" />

                                <linearGradient id="SVGID_00000003809248562311044930000017615248998795763639_"
                                    gradientUnits="userSpaceOnUse" x1="990.5818" y1="783.6824" x2="1022.128"
                                    y2="831.0094" gradientTransform="matrix(1 0 0 -1 0 1483.7244)">
                                    <stop offset="0" style="stop-color:#DCD8E0" />
                                    <stop offset="1" style="stop-color:#DCD8E0;stop-opacity:0" />
                                </linearGradient>
                                <path style="fill:url(#SVGID_00000003809248562311044930000017615248998795763639_);"
                                    d="M1033.6,707.9h-17.1
			c-2.8,0-5.2-2.3-5.2-5.2V593.9c0-2.8,2.3-5.2,5.2-5.2h17.1c2.8,0,5.2,2.3,5.2,5.2v108.8C1038.9,705.6,1036.5,707.9,1033.6,707.9z" />
                            </g>
                            <g>

                                <linearGradient id="SVGID_00000076566491748240042010000016375437238155833493_"
                                    gradientUnits="userSpaceOnUse" x1="1057.1569" y1="835.4533" x2="1084.7394"
                                    y2="835.4533" gradientTransform="matrix(1 0 0 -1 0 1483.7244)">
                                    <stop offset="0" style="stop-color:#D3CDD8" />
                                    <stop offset="1" style="stop-color:#C6C0CB" />
                                </linearGradient>
                                <path style="fill:url(#SVGID_00000076566491748240042010000016375437238155833493_);"
                                    d="M1079.5,707.9h-17.1
			c-2.8,0-5.2-2.3-5.2-5.2V593.9c0-2.8,2.3-5.2,5.2-5.2h17.1c2.8,0,5.2,2.3,5.2,5.2v108.8C1084.7,705.6,1082.5,707.9,1079.5,707.9z" />

                                <linearGradient id="SVGID_00000005227865331651683070000007409812442365487271_"
                                    gradientUnits="userSpaceOnUse" x1="1057.2083" y1="835.4533" x2="1063.7754"
                                    y2="835.4533" gradientTransform="matrix(1 0 0 -1 0 1483.7244)">
                                    <stop offset="0" style="stop-color:#DCD8E0" />
                                    <stop offset="1" style="stop-color:#DCD8E0;stop-opacity:0" />
                                </linearGradient>
                                <path style="fill:url(#SVGID_00000005227865331651683070000007409812442365487271_);"
                                    d="M1079.5,707.9h-17.1
			c-2.8,0-5.2-2.3-5.2-5.2V593.9c0-2.8,2.3-5.2,5.2-5.2h17.1c2.8,0,5.2,2.3,5.2,5.2v108.8C1084.7,705.6,1082.5,707.9,1079.5,707.9z" />

                                <linearGradient id="SVGID_00000011730446116722445470000005520466008732340629_"
                                    gradientUnits="userSpaceOnUse" x1="1036.4753" y1="783.6769" x2="1068.0215"
                                    y2="831.0039" gradientTransform="matrix(1 0 0 -1 0 1483.7244)">
                                    <stop offset="0" style="stop-color:#DCD8E0" />
                                    <stop offset="1" style="stop-color:#DCD8E0;stop-opacity:0" />
                                </linearGradient>
                                <path style="fill:url(#SVGID_00000011730446116722445470000005520466008732340629_);"
                                    d="M1079.5,707.9h-17.1
			c-2.8,0-5.2-2.3-5.2-5.2V593.9c0-2.8,2.3-5.2,5.2-5.2h17.1c2.8,0,5.2,2.3,5.2,5.2v108.8C1084.7,705.6,1082.5,707.9,1079.5,707.9z" />
                            </g>
                            <g>

                                <linearGradient id="SVGID_00000000203518933183534030000007075153740450149776_"
                                    gradientUnits="userSpaceOnUse" x1="1103.0421" y1="835.4533" x2="1130.6248"
                                    y2="835.4533" gradientTransform="matrix(1 0 0 -1 0 1483.7244)">
                                    <stop offset="0" style="stop-color:#D3CDD8" />
                                    <stop offset="1" style="stop-color:#C6C0CB" />
                                </linearGradient>
                                <path style="fill:url(#SVGID_00000000203518933183534030000007075153740450149776_);"
                                    d="M1125.4,707.9h-17.1
			c-2.8,0-5.2-2.3-5.2-5.2V593.9c0-2.8,2.3-5.2,5.2-5.2h17.1c2.8,0,5.2,2.3,5.2,5.2v108.8C1130.6,705.6,1128.3,707.9,1125.4,707.9z" />

                                <linearGradient id="SVGID_00000158706852709834221710000016194556029731494069_"
                                    gradientUnits="userSpaceOnUse" x1="1103.0935" y1="835.4533" x2="1109.6606"
                                    y2="835.4533" gradientTransform="matrix(1 0 0 -1 0 1483.7244)">
                                    <stop offset="0" style="stop-color:#DCD8E0" />
                                    <stop offset="1" style="stop-color:#DCD8E0;stop-opacity:0" />
                                </linearGradient>
                                <path style="fill:url(#SVGID_00000158706852709834221710000016194556029731494069_);"
                                    d="M1125.4,707.9h-17.1
			c-2.8,0-5.2-2.3-5.2-5.2V593.9c0-2.8,2.3-5.2,5.2-5.2h17.1c2.8,0,5.2,2.3,5.2,5.2v108.8C1130.6,705.6,1128.3,707.9,1125.4,707.9z" />

                                <linearGradient id="SVGID_00000000932894087859349150000016381405496402972804_"
                                    gradientUnits="userSpaceOnUse" x1="1082.3607" y1="783.6769" x2="1113.9069"
                                    y2="831.0039" gradientTransform="matrix(1 0 0 -1 0 1483.7244)">
                                    <stop offset="0" style="stop-color:#DCD8E0" />
                                    <stop offset="1" style="stop-color:#DCD8E0;stop-opacity:0" />
                                </linearGradient>
                                <path style="fill:url(#SVGID_00000000932894087859349150000016381405496402972804_);"
                                    d="M1125.4,707.9h-17.1
			c-2.8,0-5.2-2.3-5.2-5.2V593.9c0-2.8,2.3-5.2,5.2-5.2h17.1c2.8,0,5.2,2.3,5.2,5.2v108.8C1130.6,705.6,1128.3,707.9,1125.4,707.9z" />
                            </g>

                            <linearGradient id="SVGID_00000176764883482098130150000015050499929610161314_"
                                gradientUnits="userSpaceOnUse" x1="987.5626" y1="739.0942" x2="1000.1095" y2="739.0942"
                                gradientTransform="matrix(1 0 0 -1 0 1483.7244)">
                                <stop offset="0" style="stop-color:#9B96A0" />
                                <stop offset="1" style="stop-color:#6A6970" />
                            </linearGradient>

                            <rect x="978.5" y="735.5"
                                style="fill:url(#SVGID_00000176764883482098130150000015050499929610161314_);"
                                width="19.7" height="18.4" />

                            <linearGradient id="SVGID_00000180338059938557117300000004636294740369260735_"
                                gradientUnits="userSpaceOnUse" x1="1148.9789" y1="739.0942" x2="992.9688" y2="739.0942"
                                gradientTransform="matrix(1 0 0 -1 0 1483.7244)">
                                <stop offset="0" style="stop-color:#8C8892" />
                                <stop offset="1" style="stop-color:#AAA3AE" />
                            </linearGradient>
                            <path style="fill:url(#SVGID_00000180338059938557117300000004636294740369260735_);" d="M993,752.4c0,0.8,0.6,1.4,1.4,1.4h145.4
		c5.1,0,9.2-4.1,9.2-9.2v-9.2H993V752.4z" />

                            <linearGradient id="SVGID_00000030451081108347684580000014169069766211073412_"
                                gradientUnits="userSpaceOnUse" x1="992.9688" y1="739.0942" x2="1002.8654" y2="739.0942"
                                gradientTransform="matrix(1 0 0 -1 0 1483.7244)">
                                <stop offset="0" style="stop-color:#666F6E" />
                                <stop offset="1" style="stop-color:#666F6E;stop-opacity:0" />
                            </linearGradient>
                            <path style="fill:url(#SVGID_00000030451081108347684580000014169069766211073412_);" d="M993,752.4c0,0.8,0.6,1.4,1.4,1.4h145.4
		c5.1,0,9.2-4.1,9.2-9.2v-9.2H993V752.4z" />

                            <linearGradient id="SVGID_00000128472918679811263840000010242832048031751078_"
                                gradientUnits="userSpaceOnUse" x1="1148.9789" y1="739.0942" x2="1131.7424" y2="739.0942"
                                gradientTransform="matrix(1 0 0 -1 0 1483.7244)">
                                <stop offset="0" style="stop-color:#C5C1C7" />
                                <stop offset="1" style="stop-color:#C5C1C7;stop-opacity:0" />
                            </linearGradient>
                            <path style="fill:url(#SVGID_00000128472918679811263840000010242832048031751078_);" d="M993,752.4c0,0.8,0.6,1.4,1.4,1.4h145.4
		c5.1,0,9.2-4.1,9.2-9.2v-9.2H993V752.4z" />

                            <linearGradient id="SVGID_00000049196107653856539760000016845207255404877499_"
                                gradientUnits="userSpaceOnUse" x1="1070.9739" y1="728.3313" x2="1070.9739" y2="739.0942"
                                gradientTransform="matrix(1 0 0 -1 0 1483.7244)">
                                <stop offset="0" style="stop-color:#836F92" />
                                <stop offset="1" style="stop-color:#836F92;stop-opacity:0" />
                            </linearGradient>
                            <path style="fill:url(#SVGID_00000049196107653856539760000016845207255404877499_);" d="M993,752.4c0,0.8,0.6,1.4,1.4,1.4h145.4
		c5.1,0,9.2-4.1,9.2-9.2v-9.2H993V752.4z" />
                            <g>

                                <linearGradient id="SVGID_00000046327916424647703250000003325828195795234737_"
                                    gradientUnits="userSpaceOnUse" x1="983.7917" y1="739.0942" x2="892.0212"
                                    y2="739.0942" gradientTransform="matrix(1 0 0 -1 0 1483.7244)">
                                    <stop offset="0" style="stop-color:#ABA5B1" />
                                    <stop offset="1" style="stop-color:#B7B2BB" />
                                </linearGradient>
                                <path style="fill:url(#SVGID_00000046327916424647703250000003325828195795234737_);" d="M983.8,735.5H892v9.2
			c0,5,4.1,9.2,9.2,9.2h81.2c0.8,0,1.4-0.6,1.4-1.4V735.5z" />

                                <linearGradient id="SVGID_00000093870465960199241060000015087679859387410868_"
                                    gradientUnits="userSpaceOnUse" x1="937.9065" y1="749.2109" x2="937.9065"
                                    y2="746.7736" gradientTransform="matrix(1 0 0 -1 0 1483.7244)">
                                    <stop offset="0" style="stop-color:#666369" />
                                    <stop offset="1" style="stop-color:#666369;stop-opacity:0" />
                                </linearGradient>
                                <path style="fill:url(#SVGID_00000093870465960199241060000015087679859387410868_);" d="M983.8,735.5H892v9.2
			c0,5,4.1,9.2,9.2,9.2h81.2c0.8,0,1.4-0.6,1.4-1.4V735.5z" />

                                <linearGradient id="SVGID_00000005258285802124672620000004038956645723935905_"
                                    gradientUnits="userSpaceOnUse" x1="986.3439" y1="739.0942" x2="981.4691"
                                    y2="739.0942" gradientTransform="matrix(1 0 0 -1 0 1483.7244)">
                                    <stop offset="0" style="stop-color:#666369" />
                                    <stop offset="1" style="stop-color:#666369;stop-opacity:0" />
                                </linearGradient>
                                <path style="fill:url(#SVGID_00000005258285802124672620000004038956645723935905_);" d="M983.8,735.5H892v9.2
			c0,5,4.1,9.2,9.2,9.2h81.2c0.8,0,1.4-0.6,1.4-1.4V735.5z" />
                            </g>

                            <linearGradient id="SVGID_00000153671579274558584920000002506633941636009629_"
                                gradientUnits="userSpaceOnUse" x1="937.9065" y1="729.9171" x2="937.9065" y2="735.661"
                                gradientTransform="matrix(1 0 0 -1 0 1483.7244)">
                                <stop offset="0" style="stop-color:#857095" />
                                <stop offset="1" style="stop-color:#857095;stop-opacity:0" />
                            </linearGradient>
                            <path style="fill:url(#SVGID_00000153671579274558584920000002506633941636009629_);" d="M983.8,735.5H892v9.2c0,5,4.1,9.2,9.2,9.2
		h81.2c0.8,0,1.4-0.6,1.4-1.4V735.5z" />

                            <linearGradient id="SVGID_00000075879347118445967800000017794892968009519039_"
                                gradientUnits="userSpaceOnUse" x1="914.0926" y1="847.2439" x2="928.803" y2="841.1898"
                                gradientTransform="matrix(1 0 0 -1 0 1483.7244)">
                                <stop offset="9.126520e-02" style="stop-color:#353139" />
                                <stop offset="0.3708" style="stop-color:#614F70" />
                            </linearGradient>
                            <path style="fill:url(#SVGID_00000075879347118445967800000017794892968009519039_);" d="M937.9,643.7c0-5-4.2-9.3-9.3-9.3h-13.8
		l-4.6,9.3H937.9z" />
                            <g>
                                <path class="st79"
                                    d="M900.4,726.3H892v-36.7h8.4c5.5,0,10,4.5,10,10v16.7C910.4,721.8,905.9,726.3,900.4,726.3z" />

                                <linearGradient id="SVGID_00000091723664439598468400000010819347472143611301_"
                                    gradientUnits="userSpaceOnUse" x1="891.1215" y1="775.8024" x2="897.0029"
                                    y2="775.8024" gradientTransform="matrix(1 0 0 -1 0 1483.7244)">
                                    <stop offset="0" style="stop-color:#DABB4B" />
                                    <stop offset="1" style="stop-color:#DABB4B;stop-opacity:0" />
                                </linearGradient>
                                <path style="fill:url(#SVGID_00000091723664439598468400000010819347472143611301_);" d="M900.4,726.3H892v-36.7h8.4
			c5.5,0,10,4.5,10,10v16.7C910.4,721.8,905.9,726.3,900.4,726.3z" />
                            </g>

                            <radialGradient id="SVGID_00000102534045485067726330000002803319287256699327_"
                                cx="-694.6136" cy="726.2144" r="9.1771"
                                gradientTransform="matrix(2.0938 -0.4679 -0.6697 -2.997 3074.1621 2577.4563)"
                                gradientUnits="userSpaceOnUse">
                                <stop offset="0" style="stop-color:#DB2979" />
                                <stop offset="1" style="stop-color:#BE0564" />
                            </radialGradient>
                            <path style="fill:url(#SVGID_00000102534045485067726330000002803319287256699327_);" d="M1149,707.9h-4.6
		c-7.8,0-14.1,6.5-13.8,14.4c0.4,7.4,6.8,13.1,14.2,13.1h4.1V707.9z" />

                            <linearGradient id="SVGID_00000090283044043448761370000015944364940320388481_"
                                gradientUnits="userSpaceOnUse" x1="1034.2651" y1="737.6681" x2="1034.2651" y2="770.6596"
                                gradientTransform="matrix(1 0 0 -1 0 1483.7244)">
                                <stop offset="0" style="stop-color:#62536D" />
                                <stop offset="1" style="stop-color:#4D4257" />
                            </linearGradient>
                            <path style="fill:url(#SVGID_00000090283044043448761370000015944364940320388481_);"
                                d="M999.1,753.8h70.4
		c0.2-1.7,0.4-3.4,0.4-5.2c0-19.6-15.9-35.6-35.6-35.6c-19.6,0-35.6,15.9-35.6,35.6C998.7,750.4,998.8,752.1,999.1,753.8z" />

                            <linearGradient id="SVGID_00000121239752078653121850000006503353750042477732_"
                                gradientUnits="userSpaceOnUse" x1="942.3624" y1="737.6681" x2="942.3624" y2="770.6596"
                                gradientTransform="matrix(1 0 0 -1 0 1483.7244)">
                                <stop offset="0" style="stop-color:#62536D" />
                                <stop offset="1" style="stop-color:#4D4257" />
                            </linearGradient>
                            <path style="fill:url(#SVGID_00000121239752078653121850000006503353750042477732_);"
                                d="M907.2,753.8h70.4
		c0.2-1.7,0.4-3.4,0.4-5.2c0-19.6-15.9-35.6-35.6-35.6c-19.6,0-35.6,15.9-35.6,35.6C906.8,750.4,906.9,752.1,907.2,753.8z" />

                            <linearGradient id="SVGID_00000023974869722856642750000016011512369193718416_"
                                gradientUnits="userSpaceOnUse" x1="1098.4127" y1="737.6681" x2="1098.4127" y2="770.6596"
                                gradientTransform="matrix(1 0 0 -1 0 1483.7244)">
                                <stop offset="0" style="stop-color:#62536D" />
                                <stop offset="1" style="stop-color:#4D4257" />
                            </linearGradient>
                            <path style="fill:url(#SVGID_00000023974869722856642750000016011512369193718416_);"
                                d="M1063.2,753.8h70.4
		c0.2-1.7,0.4-3.4,0.4-5.2c0-19.6-15.9-35.6-35.6-35.6c-19.6,0-35.6,15.9-35.6,35.6C1062.9,750.4,1063,752.1,1063.2,753.8z" />
                            <g>

                                <linearGradient id="SVGID_00000047029596979365713310000016975114274415151024_"
                                    gradientUnits="userSpaceOnUse" x1="927.6841" y1="734.5056" x2="975.9288"
                                    y2="734.5056" gradientTransform="matrix(1 0 0 -1 0 1483.7244)">
                                    <stop offset="0.239" style="stop-color:#34214F" />
                                    <stop offset="1" style="stop-color:#241337" />
                                </linearGradient>
                                <path style="fill:url(#SVGID_00000047029596979365713310000016975114274415151024_);" d="M942.5,781.3c17.7,0,32.1-14.4,32.1-32.1
			s-14.4-32.1-32.1-32.1s-32.1,14.4-32.1,32.1S924.8,781.3,942.5,781.3z" />

                                <radialGradient id="SVGID_00000033335878812984679000000006877932292218162337_"
                                    cx="-1611.684" cy="-425.0296" r="9.1771"
                                    gradientTransform="matrix(0.7908 -1.7383 -1.8155 -0.826 1445.4015 -2406.2498)"
                                    gradientUnits="userSpaceOnUse">
                                    <stop offset="0.5231" style="stop-color:#2D114D" />
                                    <stop offset="1" style="stop-color:#2B1249;stop-opacity:0" />
                                </radialGradient>
                                <path style="fill:url(#SVGID_00000033335878812984679000000006877932292218162337_);" d="M942.5,781.3c17.7,0,32.1-14.4,32.1-32.1
			s-14.4-32.1-32.1-32.1s-32.1,14.4-32.1,32.1S924.8,781.3,942.5,781.3z" />
                            </g>
                            <g>
                                <path class="st87" d="M942.5,761c6.5,0,11.8-5.3,11.8-11.8c0-6.5-5.3-11.8-11.8-11.8c-6.5,0-11.8,5.3-11.8,11.8
			C930.7,755.7,936,761,942.5,761z" />
                            </g>
                            <g>

                                <linearGradient id="SVGID_00000093880117215352870730000017273910006318132650_"
                                    gradientUnits="userSpaceOnUse" x1="1083.6024" y1="734.5056" x2="1131.847"
                                    y2="734.5056" gradientTransform="matrix(1 0 0 -1 0 1483.7244)">
                                    <stop offset="0.239" style="stop-color:#34214F" />
                                    <stop offset="1" style="stop-color:#241337" />
                                </linearGradient>
                                <path style="fill:url(#SVGID_00000093880117215352870730000017273910006318132650_);" d="M1098.4,781.3
			c17.7,0,32.1-14.4,32.1-32.1s-14.4-32.1-32.1-32.1s-32.1,14.4-32.1,32.1S1080.7,781.3,1098.4,781.3z" />

                                <radialGradient id="SVGID_00000016773853685521064240000007468205270262276259_"
                                    cx="-1581.5577" cy="-488.4285" r="9.1771"
                                    gradientTransform="matrix(0.7908 -1.7383 -1.8155 -0.826 1462.3915 -2406.2498)"
                                    gradientUnits="userSpaceOnUse">
                                    <stop offset="0.5231" style="stop-color:#2D114D" />
                                    <stop offset="1" style="stop-color:#2B1249;stop-opacity:0" />
                                </radialGradient>
                                <path style="fill:url(#SVGID_00000016773853685521064240000007468205270262276259_);" d="M1098.4,781.3
			c17.7,0,32.1-14.4,32.1-32.1s-14.4-32.1-32.1-32.1s-32.1,14.4-32.1,32.1S1080.7,781.3,1098.4,781.3z" />
                            </g>
                            <g>

                                <linearGradient id="SVGID_00000094590120887124410820000001276466908177120931_"
                                    gradientUnits="userSpaceOnUse" x1="1019.4547" y1="734.5056" x2="1067.6995"
                                    y2="734.5056" gradientTransform="matrix(1 0 0 -1 0 1483.7244)">
                                    <stop offset="0.239" style="stop-color:#34214F" />
                                    <stop offset="1" style="stop-color:#241337" />
                                </linearGradient>
                                <path style="fill:url(#SVGID_00000094590120887124410820000001276466908177120931_);" d="M1034.3,781.3
			c17.7,0,32.1-14.4,32.1-32.1s-14.4-32.1-32.1-32.1s-32.1,14.4-32.1,32.1S1016.5,781.3,1034.3,781.3z" />

                                <radialGradient id="SVGID_00000166655053966541841990000011481596033741884074_"
                                    cx="-1593.9523" cy="-462.345" r="9.1771"
                                    gradientTransform="matrix(0.7908 -1.7383 -1.8155 -0.826 1455.4015 -2406.2498)"
                                    gradientUnits="userSpaceOnUse">
                                    <stop offset="0.5231" style="stop-color:#2D114D" />
                                    <stop offset="1" style="stop-color:#2B1249;stop-opacity:0" />
                                </radialGradient>
                                <path style="fill:url(#SVGID_00000166655053966541841990000011481596033741884074_);" d="M1034.3,781.3
			c17.7,0,32.1-14.4,32.1-32.1s-14.4-32.1-32.1-32.1s-32.1,14.4-32.1,32.1S1016.5,781.3,1034.3,781.3z" />
                            </g>
                            <g>
                                <path class="st87" d="M1034.3,761c6.5,0,11.8-5.3,11.8-11.8c0-6.5-5.3-11.8-11.8-11.8c-6.5,0-11.8,5.3-11.8,11.8
			C1022.5,755.7,1027.8,761,1034.3,761z" />
                            </g>
                            <g>
                                <path class="st87" d="M1098.4,761c6.5,0,11.8-5.3,11.8-11.8c0-6.5-5.3-11.8-11.8-11.8c-6.5,0-11.8,5.3-11.8,11.8
			C1086.6,755.7,1091.9,761,1098.4,761z" />
                            </g>
                            <g>

                                <linearGradient id="SVGID_00000121261290992335451180000014911729366080081290_"
                                    gradientUnits="userSpaceOnUse" x1="1117.9332" y1="748.9527" x2="1082.212"
                                    y2="725.6074" gradientTransform="matrix(1 0 0 -1 0 1483.7244)">
                                    <stop offset="8.301220e-02" style="stop-color:#615B6B" />
                                    <stop offset="0.3908" style="stop-color:#615B6B;stop-opacity:0" />
                                    <stop offset="0.6924" style="stop-color:#615B6B;stop-opacity:0" />
                                    <stop offset="0.935" style="stop-color:#615B6B" />
                                </linearGradient>

                                <circle
                                    style="fill:none;stroke:url(#SVGID_00000121261290992335451180000014911729366080081290_);stroke-width:0.85;"
                                    cx="1099.8" cy="746.6" r="22.7" />
                            </g>
                            <g>

                                <linearGradient id="SVGID_00000082339420920287556850000009816068964454978482_"
                                    gradientUnits="userSpaceOnUse" x1="1052.6427" y1="748.9531" x2="1016.9215"
                                    y2="725.6078" gradientTransform="matrix(1 0 0 -1 0 1483.7244)">
                                    <stop offset="8.301220e-02" style="stop-color:#615B6B" />
                                    <stop offset="0.3908" style="stop-color:#615B6B;stop-opacity:0" />
                                    <stop offset="0.6924" style="stop-color:#615B6B;stop-opacity:0" />
                                    <stop offset="0.935" style="stop-color:#615B6B" />
                                </linearGradient>

                                <circle
                                    style="fill:none;stroke:url(#SVGID_00000082339420920287556850000009816068964454978482_);stroke-width:0.85;"
                                    cx="1034.5" cy="746.6" r="22.7" />
                            </g>
                            <g>

                                <linearGradient id="SVGID_00000020356499982322618110000015245944509569871026_"
                                    gradientUnits="userSpaceOnUse" x1="960.6311" y1="748.9528" x2="924.9101"
                                    y2="725.6075" gradientTransform="matrix(1 0 0 -1 0 1483.7244)">
                                    <stop offset="8.301220e-02" style="stop-color:#615B6B" />
                                    <stop offset="0.3908" style="stop-color:#615B6B;stop-opacity:0" />
                                    <stop offset="0.6924" style="stop-color:#615B6B;stop-opacity:0" />
                                    <stop offset="0.935" style="stop-color:#615B6B" />
                                </linearGradient>

                                <circle
                                    style="fill:none;stroke:url(#SVGID_00000020356499982322618110000015245944509569871026_);stroke-width:0.85;"
                                    cx="942.5" cy="746.6" r="22.7" />
                            </g>
                            <g>

                                <linearGradient id="SVGID_00000168092262779318753340000009013285998804273027_"
                                    gradientUnits="userSpaceOnUse" x1="971.541" y1="888.9569" x2="963.9346"
                                    y2="873.0699" gradientTransform="matrix(1 0 0 -1 0 1483.7244)">
                                    <stop offset="0" style="stop-color:#3A9475" />
                                    <stop offset="1" style="stop-color:#3A9475;stop-opacity:0" />
                                </linearGradient>

                                <path
                                    style="fill:none;stroke:url(#SVGID_00000168092262779318753340000009013285998804273027_);stroke-width:0.5;stroke-linecap:round;"
                                    d="
			M947.1,607.1l26.7-8.4c1.5-0.5,3,0.6,3,2.2v21.7" />
                            </g>

                            <radialGradient id="SVGID_00000080902347577069066700000005147169935115502262_"
                                cx="-4383.7495" cy="1094.36" r="9.1771"
                                gradientTransform="matrix(-1.3726 0 0 3.8493 -5091.2544 -3540.0093)"
                                gradientUnits="userSpaceOnUse">
                                <stop offset="0" style="stop-color:#55505E" />
                                <stop offset="0.3684" style="stop-color:#2F1C44" />
                            </radialGradient>
                            <path
                                style="fill-rule:evenodd;clip-rule:evenodd;fill:url(#SVGID_00000080902347577069066700000005147169935115502262_);"
                                d="
		M910.2,676c0-2.7,0.6-8.7,4.5-11.9c2.5-2.1,6.5-2.5,9.7-2.3c2.7,0.2,4.3,2.6,4.3,5.3v8.9v8.9c0,2.6-1.6,5-4.3,5.3
		c-3.2,0.3-7.2-0.2-9.7-2.3C910.8,684.7,910.2,678.7,910.2,676z" />

                            <linearGradient id="SVGID_00000121253315028287047300000011006807027809002650_"
                                gradientUnits="userSpaceOnUse" x1="925.8265" y1="807.7448" x2="928.7291" y2="807.7448"
                                gradientTransform="matrix(1 0 0 -1 0 1483.7244)">
                                <stop offset="0" style="stop-color:#281F4A;stop-opacity:0" />
                                <stop offset="1" style="stop-color:#281F4A" />
                            </linearGradient>
                            <path
                                style="fill-rule:evenodd;clip-rule:evenodd;fill:url(#SVGID_00000121253315028287047300000011006807027809002650_);"
                                d="
		M910.2,676c0-2.7,0.6-8.7,4.5-11.9c2.5-2.1,6.5-2.5,9.7-2.3c2.7,0.2,4.3,2.6,4.3,5.3v8.9v8.9c0,2.6-1.6,5-4.3,5.3
		c-3.2,0.3-7.2-0.2-9.7-2.3C910.8,684.7,910.2,678.7,910.2,676z" />
                        </g>
                        <g id="TRUCK-1">
                            <g>

                                <linearGradient id="SVGID_00000014616509137082491670000017917422051838716562_"
                                    gradientUnits="userSpaceOnUse" x1="-1209.703" y1="1160.5385" x2="-1109.7771"
                                    y2="1160.5385" gradientTransform="matrix(-1 0 0 -1 -71.8038 1483.7245)">
                                    <stop offset="0" style="stop-color:#C9BDD1" />
                                    <stop offset="1" style="stop-color:#EBDDF3" />
                                </linearGradient>
                                <path style="fill:url(#SVGID_00000014616509137082491670000017917422051838716562_);" d="M1142.8,350.5L1038,366.6v-85.5
			c0-0.7,0.6-1.3,1.3-1.3h59.8c5.4,0,10.4,3,12.9,7.8l29.4,56C1142.4,345.7,1142.8,348.1,1142.8,350.5z" />
                            </g>

                            <linearGradient id="SVGID_00000134212198702429686130000006884283765813569199_"
                                gradientUnits="userSpaceOnUse" x1="-1162.1973" y1="1205.3826" x2="-1162.1973"
                                y2="1198.6781" gradientTransform="matrix(-1 0 0 -1 -71.8038 1483.7245)">
                                <stop offset="0" style="stop-color:#C8C6C5" />
                                <stop offset="0.495" style="stop-color:#C8C6C5;stop-opacity:0" />
                            </linearGradient>
                            <path style="fill:url(#SVGID_00000134212198702429686130000006884283765813569199_);" d="M1142.8,350.5L1038,366.6v-85.5
		c0-0.7,0.6-1.3,1.3-1.3h59.8c5.4,0,10.4,3,12.9,7.8l29.4,56C1142.4,345.7,1142.8,348.1,1142.8,350.5z" />

                            <linearGradient id="SVGID_00000174597168470022955880000000309206411532973491_"
                                gradientUnits="userSpaceOnUse" x1="-1109.7771" y1="1160.5385" x2="-1111.5751"
                                y2="1160.5385" gradientTransform="matrix(-1 0 0 -1 -71.8038 1483.7245)">
                                <stop offset="0" style="stop-color:#604114" />
                                <stop offset="1" style="stop-color:#604114;stop-opacity:0" />
                            </linearGradient>
                            <path style="fill:url(#SVGID_00000174597168470022955880000000309206411532973491_);" d="M1142.8,350.5L1038,366.6v-85.5
		c0-0.7,0.6-1.3,1.3-1.3h59.8c5.4,0,10.4,3,12.9,7.8l29.4,56C1142.4,345.7,1142.8,348.1,1142.8,350.5z" />
                            <g>

                                <linearGradient id="SVGID_00000032617889195765494510000006024793764824414117_"
                                    gradientUnits="userSpaceOnUse" x1="-1111.4504" y1="1140.3615" x2="-978.3104"
                                    y2="1214.1095" gradientTransform="matrix(-1 0 0 -1 -71.8038 1483.7245)">
                                    <stop offset="0" style="stop-color:#F1C147" />
                                    <stop offset="1" style="stop-color:#E0B343" />
                                </linearGradient>
                                <path style="fill:url(#SVGID_00000032617889195765494510000006024793764824414117_);" d="M898.2,262.3v98.3H1038v-98.3
			c0-14.5-11.7-26.2-26.2-26.2h-87.4C909.9,236.1,898.2,247.8,898.2,262.3z" />
                            </g>
                            <path class="st22" d="M1003.8,318c0,0-0.6-1.9-0.3-1.9c0.8,0.1,3-0.7,3-0.7c-0.1,0.2-0.3,0.4-0.3,0.4c0.8,0,2.5-2,2.5-2
		c1.4,0,1.7,0.8,1.7,0.8c0.3-1.9-1.2-2.2-1.2-2.2c-0.3-1.1-3.5-1.1-3.5-1.1s-0.7-3.7,3.2-2.4c-0.1,0-0.3-0.2-0.9-0.6
		c0,0,3,1.1,4.6,0.5c0,0-1.6-0.1-2.4-0.7c0,0,3.8,0.7,5.1,0c3.5,0.6,4.3-0.9,4.3-0.9c2.2-0.8,3.1-3.3,3.1-3.3s-1.4,2.6-4.3,2.3
		c-2.9-0.3-11.4-3.5-19.6,2.9c-8.2,6.5-4.6,18.2,1.4,19.7c0,0-1.4-4.1-0.8-5.9c0,0,1.4,8.8,6.7,8.1c0,0-3.4-1.8-3.9-7.8
		c0,0,3.3,9.3,10.1,8.6c0,0-4.4-1.9-6.4-6.6c0,0,5.5,8.8,16.5,5.8C1022.3,331.2,1009.4,330.9,1003.8,318z M1016.1,307.4
		c-1.3-0.1-3.1-0.3-5.6-0.7c0,0,0,0,0,0C1012.5,306.7,1014.4,307.1,1016.1,307.4z" />

                            <linearGradient id="SVGID_00000018927102829323265250000016526599627504345514_"
                                gradientUnits="userSpaceOnUse" x1="916.3077" y1="318.0383" x2="992.7679" y2="318.0383">
                                <stop offset="0.3715" style="stop-color:#E9BA45" />
                                <stop offset="0.3746" style="stop-color:#E9BA46" />
                                <stop offset="0.8096" style="stop-color:#F9EBCA" />
                                <stop offset="1" style="stop-color:#FFFFFF" />
                            </linearGradient>
                            <path style="fill:url(#SVGID_00000018927102829323265250000016526599627504345514_);" d="M916.3,306.6h76.5
		c-0.2,0.1-0.3,0.2-0.5,0.4c-5,3.9-7.3,10-6,16.2c0.5,2.4,1.4,4.5,2.7,6.2h-72.7V306.6z" />

                            <linearGradient id="SVGID_00000089564745027177921590000016534977100793592489_"
                                gradientUnits="userSpaceOnUse" x1="-1039.8837" y1="1247.6321" x2="-1039.8837"
                                y2="1229.3717" gradientTransform="matrix(-1 0 0 -1 -71.8038 1483.7245)">
                                <stop offset="0" style="stop-color:#EAC439" />
                                <stop offset="1" style="stop-color:#EAC439;stop-opacity:0" />
                            </linearGradient>
                            <path style="fill:url(#SVGID_00000089564745027177921590000016534977100793592489_);" d="M898.2,262.3v98.3H1038v-98.3
		c0-14.5-11.7-26.2-26.2-26.2h-87.4C909.9,236.1,898.2,247.8,898.2,262.3z" />

                            <linearGradient id="SVGID_00000183249381437433256550000005420869071832000430_"
                                gradientUnits="userSpaceOnUse" x1="-969.9902" y1="1185.3772" x2="-972.5159"
                                y2="1185.3772" gradientTransform="matrix(-1 0 0 -1 -71.8038 1483.7245)">
                                <stop offset="0" style="stop-color:#DDBE7A" />
                                <stop offset="1" style="stop-color:#DDBE7A;stop-opacity:0" />
                            </linearGradient>
                            <path style="fill:url(#SVGID_00000183249381437433256550000005420869071832000430_);" d="M898.2,262.3v98.3H1038v-98.3
		c0-14.5-11.7-26.2-26.2-26.2h-87.4C909.9,236.1,898.2,247.8,898.2,262.3z" />

                            <linearGradient id="SVGID_00000103235701136300373470000007454719533872980378_"
                                gradientUnits="userSpaceOnUse" x1="-1147.9106" y1="1185.5238" x2="-1200.8767"
                                y2="1140.7484" gradientTransform="matrix(-1 0 0 -1 -71.8038 1483.7245)">
                                <stop offset="0" style="stop-color:#35A5E2" />
                                <stop offset="1" style="stop-color:#4AD3F9" />
                            </linearGradient>
                            <path style="fill:url(#SVGID_00000103235701136300373470000007454719533872980378_);" d="M1112.4,288.6h-29.9
		c-5.3,0-9.6,4.3-9.6,9.6v33.1c0,5.3,4.3,9.6,9.6,9.6h57.6L1112.4,288.6z" />

                            <linearGradient id="SVGID_00000047761938816221859580000012299018151968220579_"
                                gradientUnits="userSpaceOnUse" x1="-1178.3165" y1="1195.1249" x2="-1178.3165"
                                y2="1161.6598" gradientTransform="matrix(-1 0 0 -1 -71.8038 1483.7245)">
                                <stop offset="0" style="stop-color:#1D95DD" />
                                <stop offset="1" style="stop-color:#1D95DD;stop-opacity:0" />
                            </linearGradient>
                            <path style="fill:url(#SVGID_00000047761938816221859580000012299018151968220579_);" d="M1112.4,288.6h-29.9
		c-5.3,0-9.6,4.3-9.6,9.6v33.1c0,5.3,4.3,9.6,9.6,9.6h57.6L1112.4,288.6z" />

                            <linearGradient id="SVGID_00000179616946046244795510000004626108426084583301_"
                                gradientUnits="userSpaceOnUse" x1="-1141.113" y1="1168.9585" x2="-1153.5891"
                                y2="1168.9585" gradientTransform="matrix(-1 0 0 -1 -71.8038 1483.7245)">
                                <stop offset="0" style="stop-color:#48B8E6" />
                                <stop offset="1" style="stop-color:#48B8E6;stop-opacity:0" />
                            </linearGradient>
                            <path style="fill:url(#SVGID_00000179616946046244795510000004626108426084583301_);" d="M1112.4,288.6h-29.9
		c-5.3,0-9.6,4.3-9.6,9.6v33.1c0,5.3,4.3,9.6,9.6,9.6h57.6L1112.4,288.6z" />

                            <linearGradient id="SVGID_00000086656859130023094530000003397073345880574903_"
                                gradientUnits="userSpaceOnUse" x1="-1040.1143" y1="1134.3047" x2="-1039.7177"
                                y2="1081.2948" gradientTransform="matrix(-1 0 0 -1 -71.8038 1483.7245)">
                                <stop offset="0" style="stop-color:#FD6E33" />
                                <stop offset="1" style="stop-color:#EB3C3D" />
                            </linearGradient>
                            <path style="fill:url(#SVGID_00000086656859130023094530000003397073345880574903_);" d="M913.9,410.9c-8.6,0-15.7-7.1-15.7-15.7
		v-45.5H1038v61.2H913.9z" />

                            <linearGradient id="SVGID_00000116231892003802684030000001259704453640240016_"
                                gradientUnits="userSpaceOnUse" x1="-1109.7771" y1="1103.4771" x2="-1100.1632"
                                y2="1103.4771" gradientTransform="matrix(-1 0 0 -1 -71.8038 1483.7245)">
                                <stop offset="0.5125" style="stop-color:#EA3A0C" />
                                <stop offset="1" style="stop-color:#EA3A0C;stop-opacity:0" />
                            </linearGradient>
                            <path style="fill:url(#SVGID_00000116231892003802684030000001259704453640240016_);" d="M913.9,410.9c-8.6,0-15.7-7.1-15.7-15.7
		v-45.5H1038v61.2H913.9z" />

                            <linearGradient id="SVGID_00000062877798715920148010000001438889098807271058_"
                                gradientUnits="userSpaceOnUse" x1="-1039.8837" y1="1065.2977" x2="-1039.8837"
                                y2="1087.6855" gradientTransform="matrix(-1 0 0 -1 -71.8038 1483.7245)">
                                <stop offset="0" style="stop-color:#BC2447" />
                                <stop offset="1" style="stop-color:#BC2447;stop-opacity:0" />
                            </linearGradient>
                            <path style="fill:url(#SVGID_00000062877798715920148010000001438889098807271058_);" d="M913.9,410.9c-8.6,0-15.7-7.1-15.7-15.7
		v-45.5H1038v61.2H913.9z" />
                            <g>
                                <path class="st111" d="M968.1,406.5c0-7.2-5.9-13.1-13.1-13.1c-7.2,0-13.1,5.9-13.1,13.1c0,7.2,5.9,13.1,13.1,13.1
			C962.2,419.6,968.1,413.7,968.1,406.5z" />
                            </g>

                            <linearGradient id="SVGID_00000079455302456298663880000004834385706893695379_"
                                gradientUnits="userSpaceOnUse" x1="-984.4589" y1="1114.2804" x2="-970.5204"
                                y2="1098.1716" gradientTransform="matrix(-1 0 0 -1 -71.8038 1483.7245)">
                                <stop offset="0" style="stop-color:#BD0663" />
                                <stop offset="1" style="stop-color:#C8166A" />
                            </linearGradient>
                            <path style="fill:url(#SVGID_00000079455302456298663880000004834385706893695379_);" d="M898.2,393.4h3.9
		c7.1,0,13.2-5.4,13.5-12.5c0.3-7.5-5.7-13.7-13.1-13.7h-4.4V393.4z" />

                            <linearGradient id="SVGID_00000176756365931063313840000018125853784361046944_"
                                gradientUnits="userSpaceOnUse" x1="-1162.1973" y1="1137.8777" x2="-1162.1973"
                                y2="1072.8113" gradientTransform="matrix(-1 0 0 -1 -71.8038 1483.7245)">
                                <stop offset="0" style="stop-color:#FF7233" />
                                <stop offset="1" style="stop-color:#EE3124" />
                            </linearGradient>
                            <path style="fill:url(#SVGID_00000176756365931063313840000018125853784361046944_);" d="M1038,410.9h89.3c8.6,0,15.6-7,15.6-15.6
		v-45.7H1038V410.9z" />

                            <linearGradient id="SVGID_00000065034498312584945660000017431456146017265298_"
                                gradientUnits="userSpaceOnUse" x1="-1109.7771" y1="1103.4333" x2="-1125.8859"
                                y2="1103.4333" gradientTransform="matrix(-1 0 0 -1 -71.8038 1483.7245)">
                                <stop offset="0" style="stop-color:#FF7B3D" />
                                <stop offset="1" style="stop-color:#FF7B3D;stop-opacity:0" />
                            </linearGradient>
                            <path style="fill:url(#SVGID_00000065034498312584945660000017431456146017265298_);" d="M1038,410.9h89.3c8.6,0,15.6-7,15.6-15.6
		v-45.7H1038V410.9z" />

                            <linearGradient id="SVGID_00000152257263848947023830000008357231230444660659_"
                                gradientUnits="userSpaceOnUse" x1="-1162.1973" y1="1072.8113" x2="-1162.1973"
                                y2="1087.6418" gradientTransform="matrix(-1 0 0 -1 -71.8038 1483.7245)">
                                <stop offset="0" style="stop-color:#BC2447" />
                                <stop offset="1" style="stop-color:#BC2447;stop-opacity:0" />
                            </linearGradient>
                            <path style="fill:url(#SVGID_00000152257263848947023830000008357231230444660659_);" d="M1038,410.9h89.3c8.6,0,15.6-7,15.6-15.6
		v-45.7H1038V410.9z" />

                            <linearGradient id="SVGID_00000164501418967642789970000003321775510571427216_"
                                gradientUnits="userSpaceOnUse" x1="-1109.7771" y1="1103.4333" x2="-1111.5751"
                                y2="1103.4333" gradientTransform="matrix(-1 0 0 -1 -71.8038 1483.7245)">
                                <stop offset="0" style="stop-color:#BC2303" />
                                <stop offset="1" style="stop-color:#BC2303;stop-opacity:0" />
                            </linearGradient>
                            <path style="fill:url(#SVGID_00000164501418967642789970000003321775510571427216_);" d="M1038,410.9h89.3c8.6,0,15.6-7,15.6-15.6
		v-45.7H1038V410.9z" />

                            <linearGradient id="SVGID_00000135680062666390841660000001575696862256469130_"
                                gradientUnits="userSpaceOnUse" x1="-1156.0763" y1="1111.4528" x2="-1156.0763"
                                y2="1072.8113" gradientTransform="matrix(-1 0 0 -1 -71.8038 1483.7245)">
                                <stop offset="0" style="stop-color:#99160C" />
                                <stop offset="1" style="stop-color:#AC0819" />
                            </linearGradient>
                            <path
                                style="fill-rule:evenodd;clip-rule:evenodd;fill:url(#SVGID_00000135680062666390841660000001575696862256469130_);"
                                d="
		M1118.2,410.9c0.2-1.5,0.3-2.9,0.3-4.5c0-18.9-15.3-34.2-34.2-34.2c-18.9,0-34.2,15.3-34.2,34.2c0,1.5,0.1,3,0.3,4.5H1118.2z" />

                            <linearGradient id="SVGID_00000031180601635300000290000011606499496966313859_"
                                gradientUnits="userSpaceOnUse" x1="-1026.7786" y1="1111.4528" x2="-1026.7786"
                                y2="1072.8113" gradientTransform="matrix(-1 0 0 -1 -71.8038 1483.7245)">
                                <stop offset="0" style="stop-color:#99160C" />
                                <stop offset="1" style="stop-color:#AC0819" />
                            </linearGradient>
                            <path
                                style="fill-rule:evenodd;clip-rule:evenodd;fill:url(#SVGID_00000031180601635300000290000011606499496966313859_);"
                                d="
		M988.9,410.9c0.2-1.5,0.3-2.9,0.3-4.5c0-18.9-15.3-34.2-34.2-34.2c-18.9,0-34.2,15.3-34.2,34.2c0,1.5,0.1,3,0.3,4.5H988.9z" />
                            <g>

                                <linearGradient id="SVGID_00000035503340182933194050000013138224251260087475_"
                                    gradientUnits="userSpaceOnUse" x1="-1040.5092" y1="1077.267" x2="-994.9596"
                                    y2="1077.267" gradientTransform="matrix(-1 0 0 -1 -71.8038 1483.7245)">
                                    <stop offset="0.239" style="stop-color:#34214F" />
                                    <stop offset="1" style="stop-color:#241337" />
                                </linearGradient>
                                <path style="fill:url(#SVGID_00000035503340182933194050000013138224251260087475_);" d="M985,406.5c0-16.7-13.6-30.3-30.3-30.3
			c-16.7,0-30.3,13.6-30.3,30.3c0,16.7,13.6,30.3,30.3,30.3C971.5,436.8,985,423.2,985,406.5z" />

                                <radialGradient id="SVGID_00000128445615284141912360000009958315310632171448_"
                                    cx="-1876.0774" cy="548.0704" r="8.7367"
                                    gradientTransform="matrix(-0.7843 -1.7239 1.8005 -0.8192 -1503.5009 -2381.4558)"
                                    gradientUnits="userSpaceOnUse">
                                    <stop offset="0.5231" style="stop-color:#2D114D" />
                                    <stop offset="1" style="stop-color:#2B1249;stop-opacity:0" />
                                </radialGradient>
                                <path style="fill:url(#SVGID_00000128445615284141912360000009958315310632171448_);" d="M985,406.5c0-16.7-13.6-30.3-30.3-30.3
			c-16.7,0-30.3,13.6-30.3,30.3c0,16.7,13.6,30.3,30.3,30.3C971.5,436.8,985,423.2,985,406.5z" />
                            </g>
                            <g>
                                <path class="st111" d="M965.9,406.5c0-6.2-5-11.2-11.2-11.2c-6.2,0-11.2,5-11.2,11.2c0,6.2,5,11.2,11.2,11.2
			C960.9,417.7,965.9,412.6,965.9,406.5z" />
                            </g>
                            <path class="st121"
                                d="M1125.3,383.8v-15.9c0-5.2,4.3-9.5,9.5-9.5h8v34.9h-8C1129.6,393.4,1125.3,389.1,1125.3,383.8z" />
                            <g>

                                <linearGradient id="SVGID_00000058548639291860738250000011508537354140478126_"
                                    gradientUnits="userSpaceOnUse" x1="-1170.0597" y1="1077.267" x2="-1124.5098"
                                    y2="1077.267" gradientTransform="matrix(-1 0 0 -1 -71.8038 1483.7245)">
                                    <stop offset="0.239" style="stop-color:#34214F" />
                                    <stop offset="1" style="stop-color:#241337" />
                                </linearGradient>
                                <path style="fill:url(#SVGID_00000058548639291860738250000011508537354140478126_);"
                                    d="M1114.6,406.5
			c0-16.7-13.6-30.3-30.3-30.3c-16.7,0-30.3,13.6-30.3,30.3c0,16.7,13.6,30.3,30.3,30.3C1101,436.8,1114.6,423.2,1114.6,406.5z" />

                                <radialGradient id="SVGID_00000061460833657052391400000004130064728150776714_"
                                    cx="-1901.1616" cy="600.8589" r="8.7367"
                                    gradientTransform="matrix(-0.7843 -1.7239 1.8005 -0.8192 -1488.6726 -2381.4558)"
                                    gradientUnits="userSpaceOnUse">
                                    <stop offset="0.5231" style="stop-color:#2D114D" />
                                    <stop offset="1" style="stop-color:#2B1249;stop-opacity:0" />
                                </radialGradient>
                                <path style="fill:url(#SVGID_00000061460833657052391400000004130064728150776714_);"
                                    d="M1114.6,406.5
			c0-16.7-13.6-30.3-30.3-30.3c-16.7,0-30.3,13.6-30.3,30.3c0,16.7,13.6,30.3,30.3,30.3C1101,436.8,1114.6,423.2,1114.6,406.5z" />
                            </g>
                            <g>
                                <path class="st111" d="M1095.4,406.5c0-6.2-5-11.2-11.2-11.2c-6.2,0-11.2,5-11.2,11.2c0,6.2,5,11.2,11.2,11.2
			C1090.4,417.7,1095.4,412.6,1095.4,406.5z" />
                            </g>
                            <g>

                                <linearGradient id="SVGID_00000053543880202238336470000007135629157703085191_"
                                    gradientUnits="userSpaceOnUse" x1="-1144.4669" y1="1094.3883" x2="-1166.5109"
                                    y2="1063.9459" gradientTransform="matrix(-1 0 0 -1 -71.8038 1483.7245)">
                                    <stop offset="8.301220e-02" style="stop-color:#615B6B" />
                                    <stop offset="0.3908" style="stop-color:#615B6B;stop-opacity:0" />
                                    <stop offset="0.6924" style="stop-color:#615B6B;stop-opacity:0" />
                                    <stop offset="0.935" style="stop-color:#615B6B" />
                                </linearGradient>

                                <circle
                                    style="fill:none;stroke:url(#SVGID_00000053543880202238336470000007135629157703085191_);stroke-width:0.85;"
                                    cx="1082.9" cy="403.5" r="20.9" />
                            </g>
                            <g>

                                <linearGradient id="SVGID_00000075134562840520772110000004673682626231071889_"
                                    gradientUnits="userSpaceOnUse" x1="-1014.542" y1="1094.3883" x2="-1036.5862"
                                    y2="1063.9459" gradientTransform="matrix(-1 0 0 -1 -71.8038 1483.7245)">
                                    <stop offset="8.301220e-02" style="stop-color:#615B6B" />
                                    <stop offset="0.3908" style="stop-color:#615B6B;stop-opacity:0" />
                                    <stop offset="0.6924" style="stop-color:#615B6B;stop-opacity:0" />
                                    <stop offset="0.935" style="stop-color:#615B6B" />
                                </linearGradient>

                                <circle
                                    style="fill:none;stroke:url(#SVGID_00000075134562840520772110000004673682626231071889_);stroke-width:0.85;"
                                    cx="953" cy="403.5" r="20.9" />
                            </g>
                        </g>
                        <g id="HOUSE">

                            <linearGradient id="SVGID_00000129926639084193194140000011002668980117905598_"
                                gradientUnits="userSpaceOnUse" x1="811.5006" y1="252.7309" x2="1244.7676" y2="252.7309"
                                gradientTransform="matrix(1 0 0 -1 0 1483.7244)">
                                <stop offset="0" style="stop-color:#42CF80" />
                                <stop offset="1" style="stop-color:#50DB92" />
                            </linearGradient>
                            <path style="fill:url(#SVGID_00000129926639084193194140000011002668980117905598_);" d="M785.3,1136.2H1255v51
		c0,76.5-62.1,138.6-138.6,138.6H923.9c-76.5,0-138.6-62.1-138.6-138.6V1136.2z" />

                            <radialGradient id="SVGID_00000062168505932968418590000006404642528408911495_"
                                cx="-1958.9064" cy="3415.6831" r="16.7851"
                                gradientTransform="matrix(0 2.5362 1.2592 0 -3451.3884 5899.2349)"
                                gradientUnits="userSpaceOnUse">
                                <stop offset="0" style="stop-color:#D39364" />
                                <stop offset="1" style="stop-color:#9F6941" />
                            </radialGradient>
                            <path style="fill:url(#SVGID_00000062168505932968418590000006404642528408911495_);" d="M820.9,931.5c0-3.2,2.6-5.9,5.9-5.9h21.4
		c3.2,0,5.9,2.6,5.9,5.9v90h-33.1V931.5z" />

                            <linearGradient id="SVGID_00000124851298313762709220000014851382747790286216_"
                                gradientUnits="userSpaceOnUse" x1="818.6204" y1="510.1363" x2="832.4839" y2="510.1363"
                                gradientTransform="matrix(1 0 0 -1 0 1483.7244)">
                                <stop offset="0" style="stop-color:#8E694B" />
                                <stop offset="1" style="stop-color:#8E694B;stop-opacity:0" />
                            </linearGradient>
                            <path style="fill:url(#SVGID_00000124851298313762709220000014851382747790286216_);" d="M820.9,931.5c0-3.2,2.6-5.9,5.9-5.9h21.4
		c3.2,0,5.9,2.6,5.9,5.9v90h-33.1V931.5z" />

                            <linearGradient id="SVGID_00000018226975129288903940000001883333838099880358_"
                                gradientUnits="userSpaceOnUse" x1="840.0314" y1="505.2701" x2="833.9659" y2="512.4227"
                                gradientTransform="matrix(1 0 0 -1 0 1483.7244)">
                                <stop offset="0" style="stop-color:#C77958" />
                                <stop offset="1" style="stop-color:#C77958;stop-opacity:0" />
                            </linearGradient>
                            <path style="fill:url(#SVGID_00000018226975129288903940000001883333838099880358_);" d="M820.9,931.5c0-3.2,2.6-5.9,5.9-5.9h21.4
		c3.2,0,5.9,2.6,5.9,5.9v90h-33.1V931.5z" />

                            <linearGradient id="SVGID_00000121993704064354759520000003499569077816572572_"
                                gradientUnits="userSpaceOnUse" x1="837.4816" y1="558.5947" x2="837.4816" y2="557.0328"
                                gradientTransform="matrix(1 0 0 -1 0 1483.7244)">
                                <stop offset="0" style="stop-color:#D5AD80" />
                                <stop offset="1" style="stop-color:#D5AD80;stop-opacity:0" />
                            </linearGradient>
                            <path style="fill:url(#SVGID_00000121993704064354759520000003499569077816572572_);" d="M820.9,931.5c0-3.2,2.6-5.9,5.9-5.9h21.4
		c3.2,0,5.9,2.6,5.9,5.9v90h-33.1V931.5z" />

                            <radialGradient id="SVGID_00000031903107465827626540000001157322808901996976_"
                                cx="-4341.1265" cy="2661.1711" r="16.7851"
                                gradientTransform="matrix(-1.368 0 0 0.2941 -5080.937 144.8034)"
                                gradientUnits="userSpaceOnUse">
                                <stop offset="0" style="stop-color:#EAAA75" />
                                <stop offset="1" style="stop-color:#EAAA75;stop-opacity:0" />
                            </radialGradient>
                            <path style="fill:url(#SVGID_00000031903107465827626540000001157322808901996976_);" d="M820.9,931.5c0-3.2,2.6-5.9,5.9-5.9h21.4
		c3.2,0,5.9,2.6,5.9,5.9v90h-33.1V931.5z" />

                            <linearGradient id="SVGID_00000016077096845199471500000015849528647734529184_"
                                gradientUnits="userSpaceOnUse" x1="908.692" y1="389.0335" x2="864.8555" y2="433.0945"
                                gradientTransform="matrix(1 0 0 -1 0 1483.7244)">
                                <stop offset="0.1635" style="stop-color:#836444" />
                                <stop offset="1" style="stop-color:#D38157" />
                            </linearGradient>
                            <path style="fill:url(#SVGID_00000016077096845199471500000015849528647734529184_);" d="M988.7,1141.7H803.8V1024l92.4-94.2
		l92.4,94.2V1141.7z" />

                            <linearGradient id="SVGID_00000173128176390813985270000012850423353467905442_"
                                gradientUnits="userSpaceOnUse" x1="839.1553" y1="320.2985" x2="908.8571" y2="418.6913"
                                gradientTransform="matrix(1 0 0 -1 0 1483.7244)">
                                <stop offset="0" style="stop-color:#BA8951" />
                                <stop offset="1" style="stop-color:#BA8951;stop-opacity:0" />
                            </linearGradient>
                            <path style="fill:url(#SVGID_00000173128176390813985270000012850423353467905442_);" d="M988.7,1141.7H803.8V1024l92.4-94.2
		l92.4,94.2V1141.7z" />

                            <radialGradient id="SVGID_00000139295462930181919290000002014296826453663933_"
                                cx="-3156.7305" cy="1.2511" r="16.7851"
                                gradientTransform="matrix(-0.8847 -1.7548 -2.0969 1.0572 -1858.3748 -4405.8833)"
                                gradientUnits="userSpaceOnUse">
                                <stop offset="0" style="stop-color:#BEAB75" />
                                <stop offset="1" style="stop-color:#BEAB75;stop-opacity:0" />
                            </radialGradient>
                            <path style="fill:url(#SVGID_00000139295462930181919290000002014296826453663933_);" d="M988.7,1141.7H803.8V1024l92.4-94.2
		l92.4,94.2V1141.7z" />

                            <linearGradient id="SVGID_00000089544871977172177690000011217135801018474407_"
                                gradientUnits="userSpaceOnUse" x1="988.6615" y1="447.9822" x2="982.7246" y2="447.9822"
                                gradientTransform="matrix(1 0 0 -1 0 1483.7244)">
                                <stop offset="0" style="stop-color:#FFE6B1" />
                                <stop offset="1" style="stop-color:#FFE6B1;stop-opacity:0" />
                            </linearGradient>
                            <path style="fill:url(#SVGID_00000089544871977172177690000011217135801018474407_);" d="M988.7,1141.7H803.8V1024l92.4-94.2
		l92.4,94.2V1141.7z" />

                            <radialGradient id="SVGID_00000134248572658646795280000004100026408449582214_"
                                cx="-1920.3081" cy="7166.9707" r="16.7851"
                                gradientTransform="matrix(0 2.4613 0.51 0 -2664.1807 5743.3613)"
                                gradientUnits="userSpaceOnUse">
                                <stop offset="0.35" style="stop-color:#9E413E" />
                                <stop offset="1" style="stop-color:#9E413E;stop-opacity:0" />
                            </radialGradient>
                            <path style="fill:url(#SVGID_00000134248572658646795280000004100026408449582214_);" d="M988.7,1141.7H803.8V1024l92.4-94.2
		l92.4,94.2V1141.7z" />

                            <linearGradient id="SVGID_00000061460439747958134660000017993097291018049195_"
                                gradientUnits="userSpaceOnUse" x1="967.2004" y1="483.0564" x2="952.76" y2="466.3341"
                                gradientTransform="matrix(1 0 0 -1 0 1483.7244)">
                                <stop offset="0" style="stop-color:#9D3C3A" />
                                <stop offset="1" style="stop-color:#9D3C3A;stop-opacity:0" />
                            </linearGradient>
                            <path style="fill:url(#SVGID_00000061460439747958134660000017993097291018049195_);" d="M988.7,1141.7H803.8V1024l92.4-94.2
		l92.4,94.2V1141.7z" />

                            <linearGradient id="SVGID_00000075866632945415126720000009072226716585926066_"
                                gradientUnits="userSpaceOnUse" x1="802.6975" y1="447.9822" x2="809.0084" y2="447.9822"
                                gradientTransform="matrix(1 0 0 -1 0 1483.7244)">
                                <stop offset="0" style="stop-color:#845F3D" />
                                <stop offset="1" style="stop-color:#845F3D;stop-opacity:0" />
                            </linearGradient>
                            <path style="fill:url(#SVGID_00000075866632945415126720000009072226716585926066_);" d="M988.7,1141.7H803.8V1024l92.4-94.2
		l92.4,94.2V1141.7z" />

                            <linearGradient id="SVGID_00000094586483500129025250000002275800414312578473_"
                                gradientUnits="userSpaceOnUse" x1="894.3493" y1="566.272" x2="894.3493" y2="479.8634"
                                gradientTransform="matrix(1 0 0 -1 0 1483.7244)">
                                <stop offset="0" style="stop-color:#E85430" />
                                <stop offset="1" style="stop-color:#C11C2A" />
                            </linearGradient>
                            <path style="fill:url(#SVGID_00000094586483500129025250000002275800414312578473_);" d="M1011.2,1028.2L901.9,920.5
		c-4.1-4.1-10.7-4.1-14.7,0c0,0-0.1,0-0.1,0.1l-109.5,107.8c-4.1,4.1-4.1,10.5,0,14.5c4.1,3.9,10.7,4.1,14.7,0l99.3-97.8
		c1.6-1.6,4.3-1.6,5.9,0l98.9,97.5c4.1,4.1,10.7,4.1,14.7,0C1015.1,1038.5,1015.3,1032.1,1011.2,1028.2z" />
                            <g>

                                <linearGradient id="SVGID_00000181800523955151304430000015797297280288659610_"
                                    gradientUnits="userSpaceOnUse" x1="896.6793" y1="560.0919" x2="1010.7332"
                                    y2="442.6677" gradientTransform="matrix(1 0 0 -1 0 1483.7244)">
                                    <stop offset="0" style="stop-color:#FF8337" />
                                    <stop offset="1" style="stop-color:#F24747" />
                                </linearGradient>

                                <path
                                    style="fill:none;stroke:url(#SVGID_00000181800523955151304430000015797297280288659610_);stroke-width:0.3;stroke-linecap:round;"
                                    d="
			M896.3,925.7l109.6,107.9" />
                            </g>
                            <g>

                                <linearGradient id="SVGID_00000057827739472124507370000006441048940014703796_"
                                    gradientUnits="userSpaceOnUse" x1="895.8207" y1="560.092" x2="781.7671"
                                    y2="442.6678" gradientTransform="matrix(1 0 0 -1 0 1483.7244)">
                                    <stop offset="0" style="stop-color:#FF8337" />
                                    <stop offset="1" style="stop-color:#F24747" />
                                </linearGradient>

                                <path
                                    style="fill:none;stroke:url(#SVGID_00000057827739472124507370000006441048940014703796_);stroke-width:0.3;stroke-linecap:round;stroke-opacity:0.5;"
                                    d="
			M896.3,925.7l-109.6,107.9" />
                            </g>

                            <radialGradient id="SVGID_00000000921216012326192970000013363512989451527612_"
                                cx="-1958.9064" cy="3604.1152" r="16.7851"
                                gradientTransform="matrix(0 2.5362 1.2592 0 -3436.3574 5899.2349)"
                                gradientUnits="userSpaceOnUse">
                                <stop offset="0" style="stop-color:#FFD1A3" />
                                <stop offset="1" style="stop-color:#DFA276" />
                            </radialGradient>
                            <path style="fill:url(#SVGID_00000000921216012326192970000013363512989451527612_);" d="M1073.2,931.5c0-3.2,2.6-5.9,5.9-5.9h21.4
		c3.2,0,5.9,2.6,5.9,5.9v90h-33.1V931.5z" />

                            <linearGradient id="SVGID_00000150794170710333688910000001314772432750938276_"
                                gradientUnits="userSpaceOnUse" x1="1070.9221" y1="510.1363" x2="1084.785" y2="510.1363"
                                gradientTransform="matrix(1 0 0 -1 0 1483.7244)">
                                <stop offset="0" style="stop-color:#8E694B" />
                                <stop offset="1" style="stop-color:#8E694B;stop-opacity:0" />
                            </linearGradient>
                            <path style="fill:url(#SVGID_00000150794170710333688910000001314772432750938276_);" d="M1073.2,931.5c0-3.2,2.6-5.9,5.9-5.9h21.4
		c3.2,0,5.9,2.6,5.9,5.9v90h-33.1V931.5z" />

                            <linearGradient id="SVGID_00000037676353342861389730000012022443095519880375_"
                                gradientUnits="userSpaceOnUse" x1="1092.3339" y1="505.2699" x2="1086.2677" y2="512.4225"
                                gradientTransform="matrix(1 0 0 -1 0 1483.7244)">
                                <stop offset="0" style="stop-color:#C77958" />
                                <stop offset="1" style="stop-color:#C77958;stop-opacity:0" />
                            </linearGradient>
                            <path style="fill:url(#SVGID_00000037676353342861389730000012022443095519880375_);" d="M1073.2,931.5c0-3.2,2.6-5.9,5.9-5.9h21.4
		c3.2,0,5.9,2.6,5.9,5.9v90h-33.1V931.5z" />

                            <linearGradient id="SVGID_00000070091550788721223940000015008066931780303036_"
                                gradientUnits="userSpaceOnUse" x1="1089.7836" y1="558.5947" x2="1089.7836" y2="557.0328"
                                gradientTransform="matrix(1 0 0 -1 0 1483.7244)">
                                <stop offset="0" style="stop-color:#D5AD80" />
                                <stop offset="1" style="stop-color:#D5AD80;stop-opacity:0" />
                            </linearGradient>
                            <path style="fill:url(#SVGID_00000070091550788721223940000015008066931780303036_);" d="M1073.2,931.5c0-3.2,2.6-5.9,5.9-5.9h21.4
		c3.2,0,5.9,2.6,5.9,5.9v90h-33.1V931.5z" />

                            <radialGradient id="SVGID_00000083075283749477690730000002642071685716598451_"
                                cx="-4514.564" cy="2661.1711" r="16.7851"
                                gradientTransform="matrix(-1.368 0 0 0.2941 -5065.9058 144.8034)"
                                gradientUnits="userSpaceOnUse">
                                <stop offset="0" style="stop-color:#FFE9B1" />
                                <stop offset="1" style="stop-color:#FFE9B1;stop-opacity:0" />
                            </radialGradient>
                            <path style="fill:url(#SVGID_00000083075283749477690730000002642071685716598451_);" d="M1073.2,931.5c0-3.2,2.6-5.9,5.9-5.9h21.4
		c3.2,0,5.9,2.6,5.9,5.9v90h-33.1V931.5z" />

                            <radialGradient id="SVGID_00000111900063886412923620000013392432425221550998_"
                                cx="-1958.9064" cy="3604.1152" r="16.7851"
                                gradientTransform="matrix(0 2.5362 1.2592 0 -3436.3574 5899.2349)"
                                gradientUnits="userSpaceOnUse">
                                <stop offset="0" style="stop-color:#D39364" />
                                <stop offset="1" style="stop-color:#9F6941" />
                            </radialGradient>
                            <path style="fill:url(#SVGID_00000111900063886412923620000013392432425221550998_);" d="M1073.2,931.5c0-3.2,2.6-5.9,5.9-5.9h21.4
		c3.2,0,5.9,2.6,5.9,5.9v90h-33.1V931.5z" />

                            <linearGradient id="SVGID_00000021820257037515184340000001289022560799326649_"
                                gradientUnits="userSpaceOnUse" x1="1070.9221" y1="510.1363" x2="1084.785" y2="510.1363"
                                gradientTransform="matrix(1 0 0 -1 0 1483.7244)">
                                <stop offset="0" style="stop-color:#8E694B" />
                                <stop offset="1" style="stop-color:#8E694B;stop-opacity:0" />
                            </linearGradient>
                            <path style="fill:url(#SVGID_00000021820257037515184340000001289022560799326649_);" d="M1073.2,931.5c0-3.2,2.6-5.9,5.9-5.9h21.4
		c3.2,0,5.9,2.6,5.9,5.9v90h-33.1V931.5z" />

                            <linearGradient id="SVGID_00000061444140713126425520000012366521056118553239_"
                                gradientUnits="userSpaceOnUse" x1="1092.3339" y1="505.2699" x2="1086.2677" y2="512.4225"
                                gradientTransform="matrix(1 0 0 -1 0 1483.7244)">
                                <stop offset="0" style="stop-color:#C77958" />
                                <stop offset="1" style="stop-color:#C77958;stop-opacity:0" />
                            </linearGradient>
                            <path style="fill:url(#SVGID_00000061444140713126425520000012366521056118553239_);" d="M1073.2,931.5c0-3.2,2.6-5.9,5.9-5.9h21.4
		c3.2,0,5.9,2.6,5.9,5.9v90h-33.1V931.5z" />

                            <linearGradient id="SVGID_00000013891766946291977480000004368827792053395880_"
                                gradientUnits="userSpaceOnUse" x1="1089.7836" y1="558.5947" x2="1089.7836" y2="557.0328"
                                gradientTransform="matrix(1 0 0 -1 0 1483.7244)">
                                <stop offset="0" style="stop-color:#D5AD80" />
                                <stop offset="1" style="stop-color:#D5AD80;stop-opacity:0" />
                            </linearGradient>
                            <path style="fill:url(#SVGID_00000013891766946291977480000004368827792053395880_);" d="M1073.2,931.5c0-3.2,2.6-5.9,5.9-5.9h21.4
		c3.2,0,5.9,2.6,5.9,5.9v90h-33.1V931.5z" />

                            <radialGradient id="SVGID_00000034782383271930882000000016126937365860113337_"
                                cx="-4514.564" cy="2661.1711" r="16.7851"
                                gradientTransform="matrix(-1.368 0 0 0.2941 -5065.9058 144.8034)"
                                gradientUnits="userSpaceOnUse">
                                <stop offset="0" style="stop-color:#EAAA75" />
                                <stop offset="1" style="stop-color:#EAAA75;stop-opacity:0" />
                            </radialGradient>
                            <path style="fill:url(#SVGID_00000034782383271930882000000016126937365860113337_);" d="M1073.2,931.5c0-3.2,2.6-5.9,5.9-5.9h21.4
		c3.2,0,5.9,2.6,5.9,5.9v90h-33.1V931.5z" />

                            <linearGradient id="SVGID_00000168100361111045225990000000588708768531142029_"
                                gradientUnits="userSpaceOnUse" x1="1114.681" y1="447.9822" x2="1235.8647" y2="447.9822"
                                gradientTransform="matrix(1 0 0 -1 0 1483.7244)">
                                <stop offset="0" style="stop-color:#E39162" />
                                <stop offset="1" style="stop-color:#EBB48C" />
                            </linearGradient>
                            <path style="fill:url(#SVGID_00000168100361111045225990000000588708768531142029_);" d="M1241,1141.7h-184.8V1024l92.4-94.2
		l92.4,94.2V1141.7z" />

                            <linearGradient id="SVGID_00000182502310048275079260000007244981211927905957_"
                                gradientUnits="userSpaceOnUse" x1="1091.4573" y1="320.2983" x2="1161.1593" y2="418.6912"
                                gradientTransform="matrix(1 0 0 -1 0 1483.7244)">
                                <stop offset="0" style="stop-color:#BA8951" />
                                <stop offset="1" style="stop-color:#BA8951;stop-opacity:0" />
                            </linearGradient>
                            <path style="fill:url(#SVGID_00000182502310048275079260000007244981211927905957_);" d="M1241,1141.7h-184.8V1024l92.4-94.2
		l92.4,94.2V1141.7z" />

                            <radialGradient id="SVGID_00000097468338482255618850000000346849152784840591_"
                                cx="-3211.0833" cy="-88.9696" r="16.7851"
                                gradientTransform="matrix(-0.8847 -1.7548 -2.0969 1.0572 -1843.3434 -4405.8833)"
                                gradientUnits="userSpaceOnUse">
                                <stop offset="0" style="stop-color:#BEAB75" />
                                <stop offset="1" style="stop-color:#BEAB75;stop-opacity:0" />
                            </radialGradient>
                            <path style="fill:url(#SVGID_00000097468338482255618850000000346849152784840591_);" d="M1241,1141.7h-184.8V1024l92.4-94.2
		l92.4,94.2V1141.7z" />

                            <linearGradient id="SVGID_00000181768635225313311970000011754508019849455769_"
                                gradientUnits="userSpaceOnUse" x1="1240.9641" y1="447.9822" x2="1235.0255" y2="447.9822"
                                gradientTransform="matrix(1 0 0 -1 0 1483.7244)">
                                <stop offset="0" style="stop-color:#FFE6B1" />
                                <stop offset="1" style="stop-color:#FFE6B1;stop-opacity:0" />
                            </linearGradient>
                            <path style="fill:url(#SVGID_00000181768635225313311970000011754508019849455769_);" d="M1241,1141.7h-184.8V1024l92.4-94.2
		l92.4,94.2V1141.7z" />

                            <radialGradient id="SVGID_00000166657585373234712310000016455643855678759812_"
                                cx="-1920.3081" cy="7632.2246" r="16.7851"
                                gradientTransform="matrix(0 2.4613 0.51 0 -2649.1494 5743.3613)"
                                gradientUnits="userSpaceOnUse">
                                <stop offset="0.35" style="stop-color:#9E413E" />
                                <stop offset="1" style="stop-color:#9E413E;stop-opacity:0" />
                            </radialGradient>
                            <path style="fill:url(#SVGID_00000166657585373234712310000016455643855678759812_);" d="M1241,1141.7h-184.8V1024l92.4-94.2
		l92.4,94.2V1141.7z" />

                            <linearGradient id="SVGID_00000104665695209356467370000015424506212600870529_"
                                gradientUnits="userSpaceOnUse" x1="1219.1909" y1="473.8759" x2="1208.7388" y2="463.0771"
                                gradientTransform="matrix(1 0 0 -1 0 1483.7244)">
                                <stop offset="0" style="stop-color:#B55852" />
                                <stop offset="1" style="stop-color:#B55852;stop-opacity:0" />
                            </linearGradient>
                            <path style="fill:url(#SVGID_00000104665695209356467370000015424506212600870529_);" d="M1241,1141.7h-184.8V1024l92.4-94.2
		l92.4,94.2V1141.7z" />

                            <linearGradient id="SVGID_00000075147405051090463110000001552705502792740768_"
                                gradientUnits="userSpaceOnUse" x1="1054.9998" y1="447.9822" x2="1061.3093" y2="447.9822"
                                gradientTransform="matrix(1 0 0 -1 0 1483.7244)">
                                <stop offset="0" style="stop-color:#845F3D" />
                                <stop offset="1" style="stop-color:#845F3D;stop-opacity:0" />
                            </linearGradient>
                            <path style="fill:url(#SVGID_00000075147405051090463110000001552705502792740768_);" d="M1241,1141.7h-184.8V1024l92.4-94.2
		l92.4,94.2V1141.7z" />

                            <radialGradient id="SVGID_00000120521234656293594960000005220490049484778930_"
                                cx="-1050.6794" cy="852.0708" r="16.7851"
                                gradientTransform="matrix(2.9821 0 0 -3.4934 4281.8145 4093.0928)"
                                gradientUnits="userSpaceOnUse">
                                <stop offset="0" style="stop-color:#BB825C" />
                                <stop offset="1" style="stop-color:#BB825C;stop-opacity:0" />
                            </radialGradient>
                            <path style="fill:url(#SVGID_00000120521234656293594960000005220490049484778930_);" d="M1241,1141.7h-184.8V1024l92.4-94.2
		l92.4,94.2V1141.7z" />

                            <linearGradient id="SVGID_00000091716056732351675990000000497164619125668506_"
                                gradientUnits="userSpaceOnUse" x1="1146.6508" y1="566.272" x2="1146.6508" y2="492.4135"
                                gradientTransform="matrix(1 0 0 -1 0 1483.7244)">
                                <stop offset="0" style="stop-color:#EA6D2E" />
                                <stop offset="1" style="stop-color:#CA222B" />
                            </linearGradient>
                            <path style="fill:url(#SVGID_00000091716056732351675990000000497164619125668506_);" d="M1263.5,1028.2l-109.3-107.7
		c-4.1-4.1-10.7-4.1-14.7,0c0,0-0.1,0-0.1,0.1l-109.5,107.8c-4.1,4.1-4.1,10.5,0,14.5c4.1,3.9,10.7,4.1,14.7,0l99.3-97.8
		c1.6-1.6,4.3-1.6,5.9,0l98.9,97.5c4.1,4.1,10.7,4.1,14.7,0C1267.4,1038.5,1267.6,1032.1,1263.5,1028.2z" />
                            <g>

                                <linearGradient id="SVGID_00000002372102850873693780000001714195846865445531_"
                                    gradientUnits="userSpaceOnUse" x1="1148.9817" y1="560.0921" x2="1263.0344"
                                    y2="442.6679" gradientTransform="matrix(1 0 0 -1 0 1483.7244)">
                                    <stop offset="0" style="stop-color:#FF8337" />
                                    <stop offset="1" style="stop-color:#F24747" />
                                </linearGradient>

                                <path
                                    style="fill:none;stroke:url(#SVGID_00000002372102850873693780000001714195846865445531_);stroke-width:0.3;stroke-linecap:round;"
                                    d="
			M1148.6,925.7l109.6,107.9" />
                            </g>
                            <g>

                                <linearGradient id="SVGID_00000107585295174141376210000005468938836549500083_"
                                    gradientUnits="userSpaceOnUse" x1="1148.1218" y1="560.0921" x2="1034.0691"
                                    y2="442.6679" gradientTransform="matrix(1 0 0 -1 0 1483.7244)">
                                    <stop offset="0" style="stop-color:#FF8337" />
                                    <stop offset="1" style="stop-color:#F24747" />
                                </linearGradient>

                                <path
                                    style="fill:none;stroke:url(#SVGID_00000107585295174141376210000005468938836549500083_);stroke-width:0.3;stroke-linecap:round;stroke-opacity:0.5;"
                                    d="
			M1148.6,925.7l-109.6,107.9" />
                            </g>

                            <linearGradient id="SVGID_00000109733910341922322790000008039220511359358339_"
                                gradientUnits="userSpaceOnUse" x1="894.2042" y1="377.8784" x2="1151.6403" y2="377.8784"
                                gradientTransform="matrix(1 0 0 -1 0 1483.7244)">
                                <stop offset="0" style="stop-color:#D7905F" />
                                <stop offset="1" style="stop-color:#E8BC97" />
                            </linearGradient>
                            <path style="fill:url(#SVGID_00000109733910341922322790000008039220511359358339_);" d="M1159.2,1260.3h-275v-171.6l137.5-137.3
		l137.5,137.3V1260.3z" />

                            <linearGradient id="SVGID_00000110443308796350097740000001227525879817506750_"
                                gradientUnits="userSpaceOnUse" x1="939.0842" y1="190.1602" x2="1039.962" y2="335.543"
                                gradientTransform="matrix(1 0 0 -1 0 1483.7244)">
                                <stop offset="0" style="stop-color:#BA8951" />
                                <stop offset="1" style="stop-color:#BA8951;stop-opacity:0" />
                            </linearGradient>
                            <path style="fill:url(#SVGID_00000110443308796350097740000001227525879817506750_);" d="M1159.2,1260.3h-275v-171.6l137.5-137.3
		l137.5,137.3V1260.3z" />

                            <radialGradient id="SVGID_00000155832285473056079100000005081202031916263057_"
                                cx="-2899.2185" cy="323.5537" r="16.7851"
                                gradientTransform="matrix(-1.3164 -2.5577 -3.0938 1.5924 -1741.1843 -6680.1909)"
                                gradientUnits="userSpaceOnUse">
                                <stop offset="0" style="stop-color:#BEAB75" />
                                <stop offset="1" style="stop-color:#BEAB75;stop-opacity:0" />
                            </radialGradient>
                            <path style="fill:url(#SVGID_00000155832285473056079100000005081202031916263057_);" d="M1159.2,1260.3h-275v-171.6l137.5-137.3
		l137.5,137.3V1260.3z" />

                            <linearGradient id="SVGID_00000100341781130636411660000004863978553712108731_"
                                gradientUnits="userSpaceOnUse" x1="1159.2288" y1="377.8784" x2="1150.3931" y2="377.8784"
                                gradientTransform="matrix(1 0 0 -1 0 1483.7244)">
                                <stop offset="0" style="stop-color:#FFE6B1" />
                                <stop offset="1" style="stop-color:#FFE6B1;stop-opacity:0" />
                            </linearGradient>
                            <path style="fill:url(#SVGID_00000100341781130636411660000004863978553712108731_);" d="M1159.2,1260.3h-275v-171.6l137.5-137.3
		l137.5,137.3V1260.3z" />

                            <radialGradient id="SVGID_00000077312608583633562370000006341771302625755326_"
                                cx="-1975.751" cy="5370.0107" r="16.7851"
                                gradientTransform="matrix(0 3.5874 0.7589 0 -2912.6775 8166.2764)"
                                gradientUnits="userSpaceOnUse">
                                <stop offset="0.35" style="stop-color:#9E413E" />
                                <stop offset="1" style="stop-color:#9E413E;stop-opacity:0" />
                            </radialGradient>
                            <path style="fill:url(#SVGID_00000077312608583633562370000006341771302625755326_);" d="M1159.2,1260.3h-275v-171.6l137.5-137.3
		l137.5,137.3V1260.3z" />

                            <linearGradient id="SVGID_00000177456873807473903080000008454960112241406383_"
                                gradientUnits="userSpaceOnUse" x1="1129.811" y1="417.3423" x2="1123.8842" y2="411.4155"
                                gradientTransform="matrix(1 0 0 -1 0 1483.7244)">
                                <stop offset="0" style="stop-color:#B55852" />
                                <stop offset="1" style="stop-color:#B55852;stop-opacity:0" />
                            </linearGradient>
                            <path style="fill:url(#SVGID_00000177456873807473903080000008454960112241406383_);" d="M1159.2,1260.3h-275v-171.6l137.5-137.3
		l137.5,137.3V1260.3z" />

                            <linearGradient id="SVGID_00000083791557100235218840000010640610769856583840_"
                                gradientUnits="userSpaceOnUse" x1="882.5057" y1="377.8784" x2="891.8965" y2="377.8784"
                                gradientTransform="matrix(1 0 0 -1 0 1483.7244)">
                                <stop offset="0" style="stop-color:#845F3D" />
                                <stop offset="1" style="stop-color:#845F3D;stop-opacity:0" />
                            </linearGradient>
                            <path style="fill:url(#SVGID_00000083791557100235218840000010640610769856583840_);" d="M1159.2,1260.3h-275v-171.6l137.5-137.3
		l137.5,137.3V1260.3z" />
                            <g>

                                <linearGradient id="SVGID_00000170970265641046159270000015680873220049656740_"
                                    gradientUnits="userSpaceOnUse" x1="963.5856" y1="367.057" x2="963.5856"
                                    y2="228.2103" gradientTransform="matrix(1 0 0 -1 0 1483.7244)">
                                    <stop offset="0" style="stop-color:#805139" />
                                    <stop offset="1" style="stop-color:#6D4D2F" />
                                </linearGradient>
                                <path style="fill:url(#SVGID_00000170970265641046159270000015680873220049656740_);" d="M1007.9,1255.5h-88.6v-121.9
			c0-9.3,6.8-16.9,15.1-16.9h58.5c8.3,0,15.1,7.6,15.1,16.9V1255.5L1007.9,1255.5z" />
                            </g>
                            <g>

                                <linearGradient id="SVGID_00000143582063507174948390000003513431777898971822_"
                                    gradientUnits="userSpaceOnUse" x1="1050.4338" y1="294.3766" x2="1131.2057"
                                    y2="374.8966" gradientTransform="matrix(1 0 0 -1 0 1483.7244)">
                                    <stop offset="0" style="stop-color:#4CCCFF" />
                                    <stop offset="1" style="stop-color:#3A9EE6" />
                                </linearGradient>
                                <path style="fill:url(#SVGID_00000143582063507174948390000003513431777898971822_);" d="M1117.5,1186.6H1064
			c-6,0-10.7-4.9-10.7-10.7v-53.5c0-6,4.9-10.7,10.7-10.7h53.5c6,0,10.7,4.9,10.7,10.7v53.5
			C1128.2,1181.9,1123.5,1186.6,1117.5,1186.6z" />

                                <linearGradient id="SVGID_00000067925289760534833780000002573315818062065587_"
                                    gradientUnits="userSpaceOnUse" x1="1090.7336" y1="292.4605" x2="1090.7336"
                                    y2="307.1844" gradientTransform="matrix(1 0 0 -1 0 1483.7244)">
                                    <stop offset="0" style="stop-color:#1E9FE4" />
                                    <stop offset="1" style="stop-color:#1E9FE4;stop-opacity:0" />
                                </linearGradient>
                                <path style="fill:url(#SVGID_00000067925289760534833780000002573315818062065587_);" d="M1117.5,1186.6H1064
			c-6,0-10.7-4.9-10.7-10.7v-53.5c0-6,4.9-10.7,10.7-10.7h53.5c6,0,10.7,4.9,10.7,10.7v53.5
			C1128.2,1181.9,1123.5,1186.6,1117.5,1186.6z" />
                            </g>

                            <linearGradient id="SVGID_00000014598551264128514350000012627213520260032933_"
                                gradientUnits="userSpaceOnUse" x1="1053.3079" y1="334.5853" x2="1068.3406" y2="334.5853"
                                gradientTransform="matrix(1 0 0 -1 0 1483.7244)">
                                <stop offset="0" style="stop-color:#48E0FF" />
                                <stop offset="1" style="stop-color:#48E0FF;stop-opacity:0" />
                            </linearGradient>
                            <path style="fill:url(#SVGID_00000014598551264128514350000012627213520260032933_);" d="M1117.5,1186.6H1064
		c-6,0-10.7-4.9-10.7-10.7v-53.5c0-6,4.9-10.7,10.7-10.7h53.5c6,0,10.7,4.9,10.7,10.7v53.5
		C1128.2,1181.9,1123.5,1186.6,1117.5,1186.6z" />

                            <linearGradient id="SVGID_00000123442631271419082260000000000308249303820938_"
                                gradientUnits="userSpaceOnUse" x1="1072.965" y1="387.8913" x2="1083.0393" y2="357.668"
                                gradientTransform="matrix(1 0 0 -1 0 1483.7244)">
                                <stop offset="0" style="stop-color:#43B3F2" />
                                <stop offset="1" style="stop-color:#43B3F2;stop-opacity:0" />
                            </linearGradient>
                            <path style="fill:url(#SVGID_00000123442631271419082260000000000308249303820938_);" d="M1117.5,1186.6H1064
		c-6,0-10.7-4.9-10.7-10.7v-53.5c0-6,4.9-10.7,10.7-10.7h53.5c6,0,10.7,4.9,10.7,10.7v53.5
		C1128.2,1181.9,1123.5,1186.6,1117.5,1186.6z" />
                            <g>

                                <linearGradient id="SVGID_00000018195277998693670470000003908441727268689026_"
                                    gradientUnits="userSpaceOnUse" x1="924.1445" y1="305.5965" x2="1022.9855"
                                    y2="306.2326" gradientTransform="matrix(1 0 0 -1 0 1483.7244)">
                                    <stop offset="0" style="stop-color:#70504D" />
                                    <stop offset="1" style="stop-color:#9B665E" />
                                </linearGradient>
                                <path style="fill:url(#SVGID_00000018195277998693670470000003908441727268689026_);" d="M1023.1,1245.8h-98.8v-119.5
			c0-9.1,7.6-16.6,16.8-16.6h65.2c9.2,0,16.8,7.5,16.8,16.6V1245.8L1023.1,1245.8z" />
                            </g>
                            <g>
                                <path class="st176" d="M998.3,1187.3c3.9,0,7.1-3.2,7.1-7.1c0-3.9-3.2-7.1-7.1-7.1c-3.9,0-7.1,3.2-7.1,7.1
			C991.2,1184.1,994.4,1187.3,998.3,1187.3z" />
                            </g>

                            <linearGradient id="SVGID_00000066477585473764405220000004821938922770960782_"
                                gradientUnits="userSpaceOnUse" x1="1021.3149" y1="558.1417" x2="1021.3149" y2="367.0562"
                                gradientTransform="matrix(1 0 0 -1 0 1483.7244)">
                                <stop offset="0" style="stop-color:#EA6D2E" />
                                <stop offset="1" style="stop-color:#CA222B" />
                            </linearGradient>
                            <path style="fill:url(#SVGID_00000066477585473764405220000004821938922770960782_);" d="M1195.2,1090.3l-162.6-160.2
		c-6-6-15.9-6-21.9,0c0,0-0.2,0-0.2,0.2l-163,160.4c-6,6-6,15.7,0,21.5c6,5.9,15.9,6,21.9,0l149.2-147c1.6-1.6,4.3-1.6,5.9,0
		l148.7,146.5c6,6,15.9,6,21.9,0C1201.1,1105.7,1201.2,1096.2,1195.2,1090.3z" />
                            <g>
                                <path class="st178" d="M1000.2,1186.2c4,0,7.2-3.2,7.2-7.2c0-4-3.2-7.2-7.2-7.2c-4,0-7.2,3.2-7.2,7.2
			C993,1183,996.2,1186.2,1000.2,1186.2z" />
                            </g>

                            <linearGradient id="SVGID_00000068669928602164552800000000228602916483108534_"
                                gradientUnits="userSpaceOnUse" x1="914.8572" y1="230.6811" x2="1030.1678" y2="230.6811"
                                gradientTransform="matrix(1 0 0 -1 0 1483.7244)">
                                <stop offset="0" style="stop-color:#9FA1A3" />
                                <stop offset="1" style="stop-color:#C4C1C7" />
                            </linearGradient>
                            <path style="fill:url(#SVGID_00000068669928602164552800000000228602916483108534_);" d="M911.5,1258.4c0-7,5.6-12.6,12.6-12.6
		h97.9c7,0,12.6,5.6,12.6,12.6v1.9H911.5V1258.4z" />

                            <linearGradient id="SVGID_00000064344894827644569910000013438011738710156222_"
                                gradientUnits="userSpaceOnUse" x1="909.473" y1="230.6811" x2="924.1578" y2="230.6811"
                                gradientTransform="matrix(1 0 0 -1 0 1483.7244)">
                                <stop offset="0" style="stop-color:#59675C" />
                                <stop offset="1" style="stop-color:#59675C;stop-opacity:0" />
                            </linearGradient>
                            <path style="fill:url(#SVGID_00000064344894827644569910000013438011738710156222_);" d="M911.5,1258.4c0-7,5.6-12.6,12.6-12.6
		h97.9c7,0,12.6,5.6,12.6,12.6v1.9H911.5V1258.4z" />

                            <linearGradient id="SVGID_00000183210884495683310580000013381342738141917339_"
                                gradientUnits="userSpaceOnUse" x1="1022.1999" y1="254.1935" x2="1008.562" y2="246.9675"
                                gradientTransform="matrix(1 0 0 -1 0 1483.7244)">
                                <stop offset="0" style="stop-color:#C8CAC6" />
                                <stop offset="1" style="stop-color:#C8CAC6;stop-opacity:0" />
                            </linearGradient>
                            <path style="fill:url(#SVGID_00000183210884495683310580000013381342738141917339_);" d="M911.5,1258.4c0-7,5.6-12.6,12.6-12.6
		h97.9c7,0,12.6,5.6,12.6,12.6v1.9H911.5V1258.4z" />
                            <g>

                                <linearGradient id="SVGID_00000098922932998431210060000007582628603880567458_"
                                    gradientUnits="userSpaceOnUse" x1="1023.983" y1="549.7659" x2="1195.3739"
                                    y2="373.3114" gradientTransform="matrix(1 0 0 -1 0 1483.7244)">
                                    <stop offset="0" style="stop-color:#FF8337" />
                                    <stop offset="1" style="stop-color:#F24747" />
                                </linearGradient>

                                <path
                                    style="fill:none;stroke:url(#SVGID_00000098922932998431210060000007582628603880567458_);stroke-width:0.3;stroke-linecap:round;"
                                    d="
			M1024.1,937.8l163.1,160.6" />
                            </g>
                            <g>

                                <linearGradient id="SVGID_00000064334646238725397040000001032437246612398499_"
                                    gradientUnits="userSpaceOnUse" x1="1024.302" y1="549.7664" x2="852.9114"
                                    y2="373.3119" gradientTransform="matrix(1 0 0 -1 0 1483.7244)">
                                    <stop offset="0" style="stop-color:#FF8337" />
                                    <stop offset="1" style="stop-color:#F24747" />
                                </linearGradient>

                                <path
                                    style="fill:none;stroke:url(#SVGID_00000064334646238725397040000001032437246612398499_);stroke-width:0.3;stroke-linecap:round;stroke-opacity:0.5;"
                                    d="
			M1024.1,937.8l-163.1,160.6" />
                            </g>
                            <g>
                                <path class="st184" d="M1196.8,1260c18.2-6.6,31.1-23.8,31.1-44c0-25.9-21.3-46.9-47.7-46.9c-15.6,0-29.4,7.4-38.1,18.8
			c-6,7.9-14.5,14.5-22.6,20.3c-8.2,5.8-13.5,15.3-13.5,25.9c0,10.7,5.3,20.1,13.5,26H1196.8z" />

                                <linearGradient id="SVGID_00000181768159519893849590000006855171549826813092_"
                                    gradientUnits="userSpaceOnUse" x1="1167.0121" y1="214.4717" x2="1167.0121"
                                    y2="245.9858" gradientTransform="matrix(1 0 0 -1 0 1483.7244)">
                                    <stop offset="0" style="stop-color:#3B8478" />
                                    <stop offset="1" style="stop-color:#3B8478;stop-opacity:0" />
                                </linearGradient>
                                <path style="fill:url(#SVGID_00000181768159519893849590000006855171549826813092_);" d="M1196.8,1260c18.2-6.6,31.1-23.8,31.1-44
			c0-25.9-21.3-46.9-47.7-46.9c-15.6,0-29.4,7.4-38.1,18.8c-6,7.9-14.5,14.5-22.6,20.3c-8.2,5.8-13.5,15.3-13.5,25.9
			c0,10.7,5.3,20.1,13.5,26H1196.8z" />

                                <radialGradient id="SVGID_00000155835877667014642210000008369141309712798121_"
                                    cx="-2459.8647" cy="42.8185" r="16.7851"
                                    gradientTransform="matrix(-2.151 -5.8059 -2.6447 0.9798 -3994.4375 -13018.3105)"
                                    gradientUnits="userSpaceOnUse">
                                    <stop offset="0" style="stop-color:#2C785B" />
                                    <stop offset="1" style="stop-color:#2C785B;stop-opacity:0" />
                                </radialGradient>
                                <path style="fill:url(#SVGID_00000155835877667014642210000008369141309712798121_);" d="M1196.8,1260c18.2-6.6,31.1-23.8,31.1-44
			c0-25.9-21.3-46.9-47.7-46.9c-15.6,0-29.4,7.4-38.1,18.8c-6,7.9-14.5,14.5-22.6,20.3c-8.2,5.8-13.5,15.3-13.5,25.9
			c0,10.7,5.3,20.1,13.5,26H1196.8z" />

                                <radialGradient id="SVGID_00000047058473456325206310000007158008052569075887_"
                                    cx="-2463.1667" cy="1320.2533" r="16.7851"
                                    gradientTransform="matrix(-5.4387 4.2321 5.7282 7.3614 -19759.9688 1906.2793)"
                                    gradientUnits="userSpaceOnUse">
                                    <stop offset="0.6415" style="stop-color:#2C785B;stop-opacity:0" />
                                    <stop offset="0.966" style="stop-color:#2C785B" />
                                </radialGradient>
                                <path style="fill:url(#SVGID_00000047058473456325206310000007158008052569075887_);" d="M1196.8,1260c18.2-6.6,31.1-23.8,31.1-44
			c0-25.9-21.3-46.9-47.7-46.9c-15.6,0-29.4,7.4-38.1,18.8c-6,7.9-14.5,14.5-22.6,20.3c-8.2,5.8-13.5,15.3-13.5,25.9
			c0,10.7,5.3,20.1,13.5,26H1196.8z" />
                            </g>
                            <g>
                                <path class="st184" d="M846.6,1260c-18.2-6.6-31.1-23.8-31.1-44c0-25.9,21.3-46.9,47.7-46.9c15.6,0,29.4,7.4,38.1,18.8
			c6,7.9,14.5,14.5,22.6,20.3c8.2,5.8,13.5,15.3,13.5,25.9c0,10.7-5.3,20.1-13.5,26H846.6z" />

                                <linearGradient id="SVGID_00000098905908142561234230000009175179249259121572_"
                                    gradientUnits="userSpaceOnUse" x1="876.4191" y1="214.4717" x2="876.4191"
                                    y2="245.9858" gradientTransform="matrix(1 0 0 -1 0 1483.7244)">
                                    <stop offset="0" style="stop-color:#3B8478" />
                                    <stop offset="1" style="stop-color:#3B8478;stop-opacity:0" />
                                </linearGradient>
                                <path style="fill:url(#SVGID_00000098905908142561234230000009175179249259121572_);" d="M846.6,1260c-18.2-6.6-31.1-23.8-31.1-44
			c0-25.9,21.3-46.9,47.7-46.9c15.6,0,29.4,7.4,38.1,18.8c6,7.9,14.5,14.5,22.6,20.3c8.2,5.8,13.5,15.3,13.5,25.9
			c0,10.7-5.3,20.1-13.5,26H846.6z" />

                                <radialGradient id="SVGID_00000083079988541751792270000001384348235966793401_"
                                    cx="-2105.9316" cy="-61.0638" r="16.7851"
                                    gradientTransform="matrix(2.151 -5.8059 -2.6447 -0.9798 5228.2544 -10981.293)"
                                    gradientUnits="userSpaceOnUse">
                                    <stop offset="0" style="stop-color:#2C785B" />
                                    <stop offset="1" style="stop-color:#2C785B;stop-opacity:0" />
                                </radialGradient>
                                <path style="fill:url(#SVGID_00000083079988541751792270000001384348235966793401_);" d="M846.6,1260c-18.2-6.6-31.1-23.8-31.1-44
			c0-25.9,21.3-46.9,47.7-46.9c15.6,0,29.4,7.4,38.1,18.8c6,7.9,14.5,14.5,22.6,20.3c8.2,5.8,13.5,15.3,13.5,25.9
			c0,10.7-5.3,20.1-13.5,26H846.6z" />

                                <radialGradient id="SVGID_00000057850568820604826580000013110598159797998984_"
                                    cx="-1740.766" cy="1174.0511" r="16.7851"
                                    gradientTransform="matrix(5.4387 4.232 5.7282 -7.3614 3586.6392 17210.627)"
                                    gradientUnits="userSpaceOnUse">
                                    <stop offset="0.6415" style="stop-color:#2C785B;stop-opacity:0" />
                                    <stop offset="0.966" style="stop-color:#2C785B" />
                                </radialGradient>
                                <path style="fill:url(#SVGID_00000057850568820604826580000013110598159797998984_);" d="M846.6,1260c-18.2-6.6-31.1-23.8-31.1-44
			c0-25.9,21.3-46.9,47.7-46.9c15.6,0,29.4,7.4,38.1,18.8c6,7.9,14.5,14.5,22.6,20.3c8.2,5.8,13.5,15.3,13.5,25.9
			c0,10.7-5.3,20.1-13.5,26H846.6z" />
                            </g>
                            <g>
                                <path class="st191" d="M1238,1159.6c9.9-3.6,17-13,17-24.1c0-14.2-11.7-25.7-26.1-25.7c-9.8,0-18.3,5.3-22.8,13.2
			c-1.6,2.9-4.4,5.1-7.4,6.5c-6.1,2.8-10.4,8.9-10.4,15.9c0,5.8,2.9,11,7.4,14.2H1238z" />

                                <linearGradient id="SVGID_00000127003087253890714850000009775703220398454943_"
                                    gradientUnits="userSpaceOnUse" x1="1221.6871" y1="319.0314" x2="1221.6871"
                                    y2="336.2798" gradientTransform="matrix(1 0 0 -1 0 1483.7244)">
                                    <stop offset="0" style="stop-color:#3B8478" />
                                    <stop offset="1" style="stop-color:#3B8478;stop-opacity:0" />
                                </linearGradient>
                                <path style="fill:url(#SVGID_00000127003087253890714850000009775703220398454943_);" d="M1238,1159.6c9.9-3.6,17-13,17-24.1
			c0-14.2-11.7-25.7-26.1-25.7c-9.8,0-18.3,5.3-22.8,13.2c-1.6,2.9-4.4,5.1-7.4,6.5c-6.1,2.8-10.4,8.9-10.4,15.9
			c0,5.8,2.9,11,7.4,14.2H1238z" />

                                <radialGradient id="SVGID_00000169516098879933774570000003804761587771937941_"
                                    cx="-2690.6636" cy="-834.146" r="16.7851"
                                    gradientTransform="matrix(-1.1773 -3.1776 -1.4474 0.5363 -3144.2297 -6917.9917)"
                                    gradientUnits="userSpaceOnUse">
                                    <stop offset="0" style="stop-color:#2C785B" />
                                    <stop offset="1" style="stop-color:#2C785B;stop-opacity:0" />
                                </radialGradient>
                                <path style="fill:url(#SVGID_00000169516098879933774570000003804761587771937941_);" d="M1238,1159.6c9.9-3.6,17-13,17-24.1
			c0-14.2-11.7-25.7-26.1-25.7c-9.8,0-18.3,5.3-22.8,13.2c-1.6,2.9-4.4,5.1-7.4,6.5c-6.1,2.8-10.4,8.9-10.4,15.9
			c0,5.8,2.9,11,7.4,14.2H1238z" />

                                <radialGradient id="SVGID_00000119109097973507324100000017156851922967934347_"
                                    cx="-2742.7954" cy="1546.3158" r="16.7851"
                                    gradientTransform="matrix(-2.9766 2.3162 3.1351 4.0289 -11772.7129 1250.2401)"
                                    gradientUnits="userSpaceOnUse">
                                    <stop offset="0.6415" style="stop-color:#2C785B;stop-opacity:0" />
                                    <stop offset="0.966" style="stop-color:#2C785B" />
                                </radialGradient>
                                <path style="fill:url(#SVGID_00000119109097973507324100000017156851922967934347_);" d="M1238,1159.6c9.9-3.6,17-13,17-24.1
			c0-14.2-11.7-25.7-26.1-25.7c-9.8,0-18.3,5.3-22.8,13.2c-1.6,2.9-4.4,5.1-7.4,6.5c-6.1,2.8-10.4,8.9-10.4,15.9
			c0,5.8,2.9,11,7.4,14.2H1238z" />
                            </g>
                            <g>
                                <path class="st195" d="M804.6,1159.6c-9.9-3.6-17-13-17-24.1c0-14.2,11.7-25.7,26.1-25.7c9.8,0,18.3,5.3,22.8,13.2
			c1.6,2.9,4.4,5.1,7.4,6.5c6.1,2.8,10.4,8.9,10.4,15.9c0,5.8-2.9,11-7.4,14.2H804.6z" />

                                <linearGradient id="SVGID_00000183211930775102147260000000187774177198456195_"
                                    gradientUnits="userSpaceOnUse" x1="820.9434" y1="319.0314" x2="820.9434"
                                    y2="336.2798" gradientTransform="matrix(1 0 0 -1 0 1483.7244)">
                                    <stop offset="0" style="stop-color:#3B8478" />
                                    <stop offset="1" style="stop-color:#3B8478;stop-opacity:0" />
                                </linearGradient>
                                <path style="fill:url(#SVGID_00000183211930775102147260000000187774177198456195_);" d="M804.6,1159.6c-9.9-3.6-17-13-17-24.1
			c0-14.2,11.7-25.7,26.1-25.7c9.8,0,18.3,5.3,22.8,13.2c1.6,2.9,4.4,5.1,7.4,6.5c6.1,2.8,10.4,8.9,10.4,15.9c0,5.8-2.9,11-7.4,14.2
			H804.6z" />

                                <radialGradient id="SVGID_00000178207222843223873570000002288414937330640789_"
                                    cx="-1423.0188" cy="1291.4181" r="16.7851"
                                    gradientTransform="matrix(2.9766 2.3162 3.135 -4.0289 990.4978 9626.3047)"
                                    gradientUnits="userSpaceOnUse">
                                    <stop offset="0.6415" style="stop-color:#2C785B;stop-opacity:0" />
                                    <stop offset="0.966" style="stop-color:#2C785B" />
                                </radialGradient>
                                <path style="fill:url(#SVGID_00000178207222843223873570000002288414937330640789_);" d="M804.6,1159.6c-9.9-3.6-17-13-17-24.1
			c0-14.2,11.7-25.7,26.1-25.7c9.8,0,18.3,5.3,22.8,13.2c1.6,2.9,4.4,5.1,7.4,6.5c6.1,2.8,10.4,8.9,10.4,15.9c0,5.8-2.9,11-7.4,14.2
			H804.6z" />
                            </g>

                            <radialGradient id="SVGID_00000147922728135522754230000013628113340461159580_"
                                cx="-2781.6245" cy="1667.6464" r="16.7851"
                                gradientTransform="matrix(-3.3629 2.0299 1.9324 3.2014 -11353.3174 1499.1935)"
                                gradientUnits="userSpaceOnUse">
                                <stop offset="0" style="stop-color:#60FB9A" />
                                <stop offset="1" style="stop-color:#60FB9A;stop-opacity:0" />
                            </radialGradient>
                            <path style="fill:url(#SVGID_00000147922728135522754230000013628113340461159580_);" d="M1196.8,1260c18.2-6.6,31.1-23.8,31.1-44
		c0-25.9-21.3-46.9-47.7-46.9c-15.6,0-29.4,7.4-38.1,18.8c-6,7.9-14.5,14.5-22.6,20.3c-8.2,5.8-13.5,15.3-13.5,25.9
		c0,10.7,5.3,20.1,13.5,26H1196.8z" />

                            <radialGradient id="SVGID_00000115514504627674970290000003405487009623064500_"
                                cx="-2468.9075" cy="1430.8237" r="16.7851"
                                gradientTransform="matrix(-3.375 3.5625 5.0414 4.776 -14629.4658 3154.863)"
                                gradientUnits="userSpaceOnUse">
                                <stop offset="0" style="stop-color:#60FB9A" />
                                <stop offset="1" style="stop-color:#60FB9A;stop-opacity:0" />
                            </radialGradient>
                            <path style="fill:url(#SVGID_00000115514504627674970290000003405487009623064500_);" d="M846.6,1260c-18.2-6.6-31.1-23.8-31.1-44
		c0-25.9,21.3-46.9,47.7-46.9c15.6,0,29.4,7.4,38.1,18.8c6,7.9,14.5,14.5,22.6,20.3c8.2,5.8,13.5,15.3,13.5,25.9
		c0,10.7-5.3,20.1-13.5,26H846.6z" />

                            <linearGradient id="SVGID_00000150095631452074367530000009778567657048716176_"
                                gradientUnits="userSpaceOnUse" x1="876.4191" y1="216.1451" x2="876.4191" y2="245.9858"
                                gradientTransform="matrix(1 0 0 -1 0 1483.7244)">
                                <stop offset="0" style="stop-color:#3B8478" />
                                <stop offset="0.8188" style="stop-color:#3B8478;stop-opacity:0" />
                            </linearGradient>
                            <path style="fill:url(#SVGID_00000150095631452074367530000009778567657048716176_);" d="M846.6,1260c-18.2-6.6-31.1-23.8-31.1-44
		c0-25.9,21.3-46.9,47.7-46.9c15.6,0,29.4,7.4,38.1,18.8c6,7.9,14.5,14.5,22.6,20.3c8.2,5.8,13.5,15.3,13.5,25.9
		c0,10.7-5.3,20.1-13.5,26H846.6z" />

                            <radialGradient id="SVGID_00000105388755156225986490000015638648097278595467_"
                                cx="-2541.8875" cy="1255.3578" r="16.7851"
                                gradientTransform="matrix(-5.9375 2.5 3.3487 7.953 -18374.543 -2429.6208)"
                                gradientUnits="userSpaceOnUse">
                                <stop offset="0.591" style="stop-color:#39895B;stop-opacity:0" />
                                <stop offset="1" style="stop-color:#39895B" />
                            </radialGradient>
                            <path style="fill:url(#SVGID_00000105388755156225986490000015638648097278595467_);" d="M846.6,1260c-18.2-6.6-31.1-23.8-31.1-44
		c0-25.9,21.3-46.9,47.7-46.9c15.6,0,29.4,7.4,38.1,18.8c6,7.9,14.5,14.5,22.6,20.3c8.2,5.8,13.5,15.3,13.5,25.9
		c0,10.7-5.3,20.1-13.5,26H846.6z" />

                            <radialGradient id="SVGID_00000129888676359081785240000000150348387636314253_"
                                cx="-3332.0808" cy="2166.8367" r="16.7851"
                                gradientTransform="matrix(-1.8405 1.111 1.0576 1.7521 -7171.7505 1027.433)"
                                gradientUnits="userSpaceOnUse">
                                <stop offset="0" style="stop-color:#60FB9A" />
                                <stop offset="1" style="stop-color:#60FB9A;stop-opacity:0" />
                            </radialGradient>
                            <path style="fill:url(#SVGID_00000129888676359081785240000000150348387636314253_);" d="M1238,1159.6c9.9-3.6,17-13,17-24.1
		c0-14.2-11.7-25.7-26.1-25.7c-9.8,0-18.3,5.3-22.8,13.2c-1.6,2.9-4.4,5.1-7.4,6.5c-6.1,2.8-10.4,8.9-10.4,15.9
		c0,5.8,2.9,11,7.4,14.2H1238z" />

                            <radialGradient id="SVGID_00000173860479301003465750000011866409685036876679_"
                                cx="-2661.4321" cy="2229.9622" r="16.7851"
                                gradientTransform="matrix(-1.4687 1.9688 1.8742 1.3982 -7246.4561 3237.7334)"
                                gradientUnits="userSpaceOnUse">
                                <stop offset="0" style="stop-color:#60FB9A" />
                                <stop offset="1" style="stop-color:#60FB9A;stop-opacity:0" />
                            </radialGradient>
                            <path style="fill:url(#SVGID_00000173860479301003465750000011866409685036876679_);" d="M804.6,1159.6c-9.9-3.6-17-13-17-24.1
		c0-14.2,11.7-25.7,26.1-25.7c9.8,0,18.3,5.3,22.8,13.2c1.6,2.9,4.4,5.1,7.4,6.5c6.1,2.8,10.4,8.9,10.4,15.9c0,5.8-2.9,11-7.4,14.2
		H804.6z" />
                            <g>
                                <path class="st204" d="M1156,1248c-9-11.4-13.5-24.5-15.2-32.5c-0.4-2-2.6-3.3-4.5-2.6l-2.7,1c-7.6,2.9-12.7,10.2-12.7,18.3
			c0,10.8,8.8,19.6,19.6,19.6h13.7C1156.1,1251.9,1157.2,1249.5,1156,1248z" />
                            </g>
                            <g>
                                <path class="st204" d="M1215.6,1153.1c-5-6.2-7.4-13.4-8.3-17.8c-0.2-1.1-1.4-1.8-2.5-1.4l-1.5,0.6c-4.2,1.6-6.9,5.6-6.9,10
			c0,5.9,4.8,10.7,10.7,10.7h7.5C1215.7,1155.2,1216.3,1153.9,1215.6,1153.1z" />
                            </g>
                            <g>
                                <path class="st204" d="M827,1153.1c5-6.2,7.4-13.4,8.3-17.8c0.2-1.1,1.4-1.8,2.5-1.4l1.5,0.6c4.2,1.6,6.9,5.6,6.9,10
			c0,5.9-4.8,10.7-10.7,10.7H828C826.9,1155.2,826.3,1153.9,827,1153.1z" />
                            </g>
                        </g>
                        <g id="BOX">
                            <g>

                                <linearGradient id="SVGID_00000089540837782428223840000006365392568674747289_"
                                    gradientUnits="userSpaceOnUse" x1="344.1661" y1="971.1596" x2="344.1661"
                                    y2="639.3371" gradientTransform="matrix(1 0 0 -1 0 1483.7244)">
                                    <stop offset="0" style="stop-color:#DEB586" />
                                    <stop offset="1" style="stop-color:#D7AA82" />
                                </linearGradient>
                                <path style="fill:url(#SVGID_00000089540837782428223840000006365392568674747289_);" d="M202.2,604.5c0-2,1-3.9,2.7-5l136.1-86
			c1.9-1.2,4.4-1.2,6.3,0l136.1,86c1.7,1.1,2.7,3,2.7,5v150.1c0,2-1.1,3.9-2.8,5l-136.1,83.9c-1.9,1.2-4.3,1.2-6.2,0L205,759.6
			c-1.7-1.1-2.8-3-2.8-5V604.5z" />

                                <linearGradient id="SVGID_00000011732679479762546370000006932915383275849611_"
                                    gradientUnits="userSpaceOnUse" x1="337.3928" y1="793.4457" x2="342.725"
                                    y2="801.9048" gradientTransform="matrix(1 0 0 -1 0 1483.7244)">
                                    <stop offset="6.560740e-02" style="stop-color:#C99D78" />
                                    <stop offset="1" style="stop-color:#DCB185;stop-opacity:0" />
                                </linearGradient>
                                <path style="fill:url(#SVGID_00000011732679479762546370000006932915383275849611_);" d="M202.2,604.5c0-2,1-3.9,2.7-5l136.1-86
			c1.9-1.2,4.4-1.2,6.3,0l136.1,86c1.7,1.1,2.7,3,2.7,5v150.1c0,2-1.1,3.9-2.8,5l-136.1,83.9c-1.9,1.2-4.3,1.2-6.2,0L205,759.6
			c-1.7-1.1-2.8-3-2.8-5V604.5z" />
                            </g>
                            <g>

                                <linearGradient id="SVGID_00000062900401093265948300000011828205707909186476_"
                                    gradientUnits="userSpaceOnUse" x1="234.2547" y1="822.966" x2="334.1686"
                                    y2="655.8233" gradientTransform="matrix(1 0 0 -1 0 1483.7244)">
                                    <stop offset="0" style="stop-color:#B98875" />
                                    <stop offset="1" style="stop-color:#AA684F" />
                                </linearGradient>
                                <path style="fill:url(#SVGID_00000062900401093265948300000011828205707909186476_);" d="M343.1,844.3c-0.7-0.1-1.4-0.4-2-0.8
			L205,759.6c-1.7-1.1-2.8-3-2.8-5V604.5l138.1,85.8c1.7,1.1,2.8,3,2.8,5V844.3z" />
                                <g class="st208">
                                    <g>
                                        <path class="st209"
                                            d="M215,692.4l-3.3,6.6l2.3,1.3l1.3-2.9C215.1,695.7,215,694,215,692.4z" />
                                        <path class="st209"
                                            d="M238.5,712.5c0.4,0.9,0.8,1.8,1.2,2.7l1.1,0.6v-2L238.5,712.5z" />
                                        <path class="st209" d="M249.3,699.7v16.2c0,0.9-0.3,1.5-0.9,1.7c-0.6,0.3-1.3,0.2-2.1-0.3c-0.8-0.5-1.5-1.3-2.1-2.2
					c-0.6-1-0.9-1.9-0.9-2.8l-1.8-1c0,1.5,0.5,3,1.5,4.6c0.9,1.6,2.1,2.7,3.3,3.5c1.3,0.8,2.5,0.9,3.4,0.5c1-0.4,1.4-1.4,1.4-2.8
					v-16.2L249.3,699.7z" />
                                        <path class="st209" d="M263.9,708.2l-2-1.2l-8.1,16.2l2.3,1.3l2.6-5.6l8.5,4.9l2.6,8.6l2,1.2L263.9,708.2z M259.3,717.5l3.6-7.5
					l3.5,11.6L259.3,717.5z" />
                                        <path class="st209"
                                            d="M285.4,720.6v17.5l-10.1-23.4l-2.5-1.4v20.9l1.9,1.1v-18.2l10.5,24.2l2,1.2v-20.9L285.4,720.6z" />
                                        <path class="st209" d="M300,729l-2-1.2l-8.1,16.2l2.3,1.3l2.6-5.6l8.5,4.9l2.6,8.6l2,1.2L300,729z M295.5,738.4l3.6-7.5
					l3.5,11.6L295.5,738.4z" />
                                        <path class="st209"
                                            d="M320,740.6v9.3l-9.3-5.4v-9.3l-1.8-1v20.9l1.8,1v-9.6l9.3,5.4v9.6l1.8,1v-20.9L320,740.6z" />
                                    </g>
                                    <path class="st4" d="M220.9,685.8l3.5,11.6l-7-4.1L220.9,685.8z M272.3,691.5c0,0-1.9,4.5-6.2,3.9c0,0-1.5,2.5-8.5-2.9
				c-2.5,0.2-10.1-5.9-10.1-5.9c1.6,2.2,4.9,4.4,4.9,4.4c-3.2-0.5-9.1-6.4-9.1-6.4c1.1,1.6,1.6,2.2,1.8,2.5
				c-7.8-7.5-6.4,1.7-6.4,1.7s6.2,3.6,6.9,6.4c0,0,2.9,2.4,2.3,6.5c0,0-0.6-2.2-3.5-3.8c0,0-3.3,2.5-5,1.6c0,0,0.3-0.1,0.5-0.5
				c0,0-4.3-0.6-5.9-1.8c-0.6-0.4,0.5,4.5,0.6,4.6c1.2,3.7,2.5,7.3,4,10.6l-2.9-1.7c-1-0.6-1.6-1.2-2-1.8c-0.6-1-0.9-1.9-0.9-2.7
				v-16.1l-1.8-1.1v15.8c0,3.3,2,6.3,4.7,7.9l4.1,2.4c12.5,26.6,31.8,38.3,31.8,38.3c-22-5.7-32.9-32.3-32.9-32.3
				c4,13.1,12.7,22.5,12.7,22.5c-13.5-6-20.2-31.2-20.2-31.2c1.1,14.3,7.8,22.3,7.8,22.3c-10.6-4.7-13.4-26.4-13.4-26.4
				c-1.1,3.5,1.7,14.6,1.7,14.6c-5.9-5.2-10.7-15.7-12-25.4l1.2-2.7l8.5,4.9l2.6,8.6l2,1.2l-7.7-25.4l-2-1.2l-4.8,9.6
				c0.1-7.6,2.8-14.1,9.6-16.3c16.4-5.3,33.4,12,39.1,15.9C269.5,695.9,272.3,691.5,272.3,691.5z M259.2,691.8
				c-3.4-2.5-7.2-5.8-11.3-8.1c0,0,0,0,0,0C253,687.6,256.5,690.1,259.2,691.8z" />
                                </g>
                            </g>

                            <linearGradient id="SVGID_00000021116472951428830450000000597356776043525009_"
                                gradientUnits="userSpaceOnUse" x1="366.8395" y1="809.7728" x2="460.9865" y2="711.9482"
                                gradientTransform="matrix(1 0 0 -1 0 1483.7244)">
                                <stop offset="0" style="stop-color:#D7A585" />
                                <stop offset="1" style="stop-color:#BD7943" />
                            </linearGradient>
                            <path style="fill:url(#SVGID_00000021116472951428830450000000597356776043525009_);"
                                d="M485.8,602.5c0.2,0.6,0.3,1.3,0.3,2v150.1
		c0,2-1.1,3.9-2.8,5l-136.1,83.9c-1.3,0.8-2.8,1-4.2,0.8V694.3c0-2,1.1-3.9,2.8-5L484.7,603C485.1,602.8,485.4,602.6,485.8,602.5z" />

                            <linearGradient id="SVGID_00000178182825772476814020000004111459004053307795_"
                                gradientUnits="userSpaceOnUse" x1="335.9502" y1="755.8782" x2="349.585" y2="756.636"
                                gradientTransform="matrix(1 0 0 -1 0 1483.7244)">
                                <stop offset="0" style="stop-color:#B46C4B" />
                                <stop offset="1" style="stop-color:#BD7E61;stop-opacity:0" />
                            </linearGradient>
                            <path style="fill:url(#SVGID_00000178182825772476814020000004111459004053307795_);"
                                d="M485.8,602.5c0.2,0.6,0.3,1.3,0.3,2v150.1
		c0,2-1.1,3.9-2.8,5l-136.1,83.9c-1.3,0.8-2.8,1-4.2,0.8V694.3c0-2,1.1-3.9,2.8-5L484.7,603C485.1,602.8,485.4,602.6,485.8,602.5z" />
                            <g>

                                <linearGradient id="SVGID_00000135692273361030819320000017588920298719895208_"
                                    gradientUnits="userSpaceOnUse" x1="292.7422" y1="726.6992" x2="323.5707"
                                    y2="667.2701" gradientTransform="matrix(1 0 0 -1 0 1483.7244)">
                                    <stop offset="0" style="stop-color:#CAB6CD" />
                                    <stop offset="1" style="stop-color:#D1BED7" />
                                </linearGradient>
                                <path style="fill:url(#SVGID_00000135692273361030819320000017588920298719895208_);" d="M284.6,758.9c0-2.8,3-4.5,5.4-3
			l36.8,22.9c1.7,1.1,2.8,3,2.8,5v26.6c0,2.8-3,4.5-5.4,3l-36.8-22.9c-1.7-1.1-2.8-3-2.8-5V758.9z" />
                            </g>
                            <g>
                                <path class="st213" d="M254.8,641.6v32.3l34.4,20.6v-30.1c0-4,2-7.7,5.4-9.9c47-30,131.5-84.8,133.6-86.8c1.9-1.4,4.4-0.7,5.1,0.4
			c0-2.2-1.2-3.5-1.7-3.9l-32.2-19.7c-1.9-1.2-4.4-1.1-6.3,0.1l-131.8,85.1C257.2,632.3,254.8,636.8,254.8,641.6z" />

                                <linearGradient id="SVGID_00000149376517916299973500000009065285695070309512_"
                                    gradientUnits="userSpaceOnUse" x1="283.9081" y1="791.7786" x2="307.4448"
                                    y2="826.7166" gradientTransform="matrix(1 0 0 -1 0 1483.7244)">
                                    <stop offset="0.6493" style="stop-color:#8D6D6C" />
                                    <stop offset="0.7258" style="stop-color:#83554C" />
                                    <stop offset="0.8253" style="stop-color:#83554C" />
                                    <stop offset="1" style="stop-color:#976A58;stop-opacity:0" />
                                </linearGradient>
                                <path style="fill:url(#SVGID_00000149376517916299973500000009065285695070309512_);" d="M254.8,641.6v32.3l34.4,20.6v-30.1
			c0-4,2-7.7,5.4-9.9c47-30,131.5-84.8,133.6-86.8c1.9-1.4,4.4-0.7,5.1,0.4c0-2.2-1.2-3.5-1.7-3.9l-32.2-19.7
			c-1.9-1.2-4.4-1.1-6.3,0.1l-131.8,85.1C257.2,632.3,254.8,636.8,254.8,641.6z" />

                                <linearGradient id="SVGID_00000093855084421324525310000006371255213494502079_"
                                    gradientUnits="userSpaceOnUse" x1="401.3023" y1="946.0054" x2="389.5351"
                                    y2="932.766" gradientTransform="matrix(1 0 0 -1 0 1483.7244)">
                                    <stop offset="0" style="stop-color:#9C6F5D" />
                                    <stop offset="1" style="stop-color:#9C6F5D;stop-opacity:0" />
                                </linearGradient>
                                <path style="fill:url(#SVGID_00000093855084421324525310000006371255213494502079_);" d="M254.8,641.6v32.3l34.4,20.6v-30.1
			c0-4,2-7.7,5.4-9.9c47-30,131.5-84.8,133.6-86.8c1.9-1.4,4.4-0.7,5.1,0.4c0-2.2-1.2-3.5-1.7-3.9l-32.2-19.7
			c-1.9-1.2-4.4-1.1-6.3,0.1l-131.8,85.1C257.2,632.3,254.8,636.8,254.8,641.6z" />
                            </g>
                            <g>
                                <path class="st216"
                                    d="M431,565.5c-0.9-0.7-2.3-0.3-2.9,0l-135.9,88.6c-0.3,0.2-1.2,0.9-2,2.2" />
                            </g>
                            <g>
                                <path class="st217" d="M346,688.7l136.8-85.3" />
                            </g>
                        </g>
                        <g id="SHIP">

                            <linearGradient id="SVGID_00000036217387402661034090000014262831193772042401_"
                                gradientUnits="userSpaceOnUse" x1="1891.8066" y1="340.2272" x2="1664.6394" y2="399.5322"
                                gradientTransform="matrix(1 0 0 -1 0 1483.7244)">
                                <stop offset="0" style="stop-color:#D3D2D2" />
                                <stop offset="0.8967" style="stop-color:#FFFFFF" />
                                <stop offset="0.9806" style="stop-color:#636363" />
                            </linearGradient>
                            <path style="fill:url(#SVGID_00000036217387402661034090000014262831193772042401_);" d="M1690.3,1073.1h168.4v72.9h-194.3l19-67.5
		C1684.2,1075.2,1687.1,1073.1,1690.3,1073.1z" />

                            <linearGradient id="SVGID_00000092457706014499327670000014251555654701255310_"
                                gradientUnits="userSpaceOnUse" x1="1678.3087" y1="374.2396" x2="1858.6681" y2="374.2396"
                                gradientTransform="matrix(1 0 0 -1 0 1483.7244)">
                                <stop offset="0" style="stop-color:#E3DBE9" />
                                <stop offset="1" style="stop-color:#E6DDED" />
                            </linearGradient>
                            <path style="fill:url(#SVGID_00000092457706014499327670000014251555654701255310_);" d="M1690.3,1073.1h168.4v72.9h-194.3l19-67.5
		C1684.2,1075.2,1687.1,1073.1,1690.3,1073.1z" />

                            <linearGradient id="SVGID_00000025409932485036896510000004068980660654339770_"
                                gradientUnits="userSpaceOnUse" x1="1761.5225" y1="410.6692" x2="1761.5225" y2="404.611"
                                gradientTransform="matrix(1 0 0 -1 0 1483.7244)">
                                <stop offset="0" style="stop-color:#F0EBF3" />
                                <stop offset="1" style="stop-color:#F0EBF3;stop-opacity:0" />
                            </linearGradient>
                            <path style="fill:url(#SVGID_00000025409932485036896510000004068980660654339770_);" d="M1690.3,1073.1h168.4v72.9h-194.3l19-67.5
		C1684.2,1075.2,1687.1,1073.1,1690.3,1073.1z" />

                            <linearGradient id="SVGID_00000066479251262919714830000007804988966179940799_"
                                gradientUnits="userSpaceOnUse" x1="1681.0575" y1="397.2085" x2="1685.7072" y2="395.8813"
                                gradientTransform="matrix(1 0 0 -1 0 1483.7244)">
                                <stop offset="9.857280e-02" style="stop-color:#A49FA7" />
                                <stop offset="1" style="stop-color:#A49FA7;stop-opacity:0" />
                            </linearGradient>
                            <path style="fill:url(#SVGID_00000066479251262919714830000007804988966179940799_);" d="M1690.3,1073.1h168.4v72.9h-194.3l19-67.5
		C1684.2,1075.2,1687.1,1073.1,1690.3,1073.1z" />
                            <g>
                                <path class="st222" d="M1761.5,1109.5C1761.5,1121.6,1761.5,1097.3,1761.5,1109.5c0-12.1-5.6-12.1-12.1-12.1H1678l-6.8,24.3h78.1
			C1755.9,1121.5,1761.5,1121.6,1761.5,1109.5z" />
                            </g>

                            <linearGradient id="SVGID_00000085215575886416607450000009198677934665322898_"
                                gradientUnits="userSpaceOnUse" x1="1531.3517" y1="283.1656" x2="1858.6681" y2="283.1656"
                                gradientTransform="matrix(1 0 0 -1 0 1483.7244)">
                                <stop offset="0" style="stop-color:#CFC9D9" />
                                <stop offset="1" style="stop-color:#E1D8EA" />
                            </linearGradient>
                            <path style="fill:url(#SVGID_00000085215575886416607450000009198677934665322898_);" d="M1858.7,1158.1h-325.3
		c-8.2,0-14.1,7.8-11.9,15.6l21.4,69.4h315.7V1158.1z" />

                            <linearGradient id="SVGID_00000092455177686107843510000011854794836516544429_"
                                gradientUnits="userSpaceOnUse" x1="1689.8625" y1="325.6668" x2="1689.8625" y2="310.1781"
                                gradientTransform="matrix(1 0 0 -1 0 1483.7244)">
                                <stop offset="0" style="stop-color:#E7E3EA" />
                                <stop offset="1" style="stop-color:#E7E3EA;stop-opacity:0" />
                            </linearGradient>
                            <path style="fill:url(#SVGID_00000092455177686107843510000011854794836516544429_);" d="M1858.7,1158.1h-325.3
		c-8.2,0-14.1,7.8-11.9,15.6l21.4,69.4h315.7V1158.1z" />

                            <linearGradient id="SVGID_00000141456816015423617980000009506110969455407295_"
                                gradientUnits="userSpaceOnUse" x1="1543.7751" y1="236.0407" x2="1556.5315" y2="240.014"
                                gradientTransform="matrix(1 0 0 -1 0 1483.7244)">
                                <stop offset="0" style="stop-color:#8E8B9C" />
                                <stop offset="1" style="stop-color:#8E8B9C;stop-opacity:0" />
                            </linearGradient>
                            <path style="fill:url(#SVGID_00000141456816015423617980000009506110969455407295_);" d="M1858.7,1158.1h-325.3
		c-8.2,0-14.1,7.8-11.9,15.6l21.4,69.4h315.7V1158.1z" />

                            <linearGradient id="SVGID_00000136399699776522170810000014025637278877356703_"
                                gradientUnits="userSpaceOnUse" x1="1700.8074" y1="1328.0601" x2="1700.8074"
                                y2="1243.0601">
                                <stop offset="0" style="stop-color:#FB4659" />
                                <stop offset="1" style="stop-color:#DF4375" />
                            </linearGradient>
                            <path style="fill:url(#SVGID_00000136399699776522170810000014025637278877356703_);" d="M1858.7,1243.1v67.9
		c-1,9.6-9.2,17.1-19.1,17.1h-263.1c-5.4,0-10.3-3.6-11.7-8.8l-1.7-5.8l-20.2-70.4H1858.7z" />

                            <linearGradient id="SVGID_00000028296402915363094820000002631434404668485802_"
                                gradientUnits="userSpaceOnUse" x1="1547.4163" y1="1241.5095" x2="1558.4645"
                                y2="1244.3823">
                                <stop offset="0" style="stop-color:#883757" />
                                <stop offset="1" style="stop-color:#883757;stop-opacity:0" />
                            </linearGradient>
                            <path style="fill:url(#SVGID_00000028296402915363094820000002631434404668485802_);" d="M1858.7,1243.1v67.9
		c-1,9.6-9.2,17.1-19.1,17.1h-263.1c-5.4,0-10.3-3.6-11.7-8.8l-1.7-5.8l-20.2-70.4H1858.7z" />

                            <linearGradient id="SVGID_00000076598215894574911040000016463800358257525419_"
                                gradientUnits="userSpaceOnUse" x1="1600.7795" y1="331.7384" x2="1812.4086" y2="331.7384"
                                gradientTransform="matrix(1 0 0 -1 0 1483.7244)">
                                <stop offset="0" style="stop-color:#58525B" />
                                <stop offset="1" style="stop-color:#725D87" />
                            </linearGradient>
                            <path style="fill:url(#SVGID_00000076598215894574911040000016463800358257525419_);" d="M1858.7,1158.1h-303.6v-5
		c0-3.9,3.2-7.1,7-7.1h296.5V1158.1z" />

                            <linearGradient id="SVGID_00000134247970896634551380000013941513318909623714_"
                                gradientUnits="userSpaceOnUse" x1="1555.0879" y1="331.7384" x2="1566.2668" y2="331.7384"
                                gradientTransform="matrix(1 0 0 -1 0 1483.7244)">
                                <stop offset="0" style="stop-color:#3D3940" />
                                <stop offset="1" style="stop-color:#3D3940;stop-opacity:0" />
                            </linearGradient>
                            <path style="fill:url(#SVGID_00000134247970896634551380000013941513318909623714_);" d="M1858.7,1158.1h-303.6v-5
		c0-3.9,3.2-7.1,7-7.1h296.5V1158.1z" />
                            <g>

                                <linearGradient id="SVGID_00000112620418654198932980000007915604808652468922_"
                                    gradientUnits="userSpaceOnUse" x1="1688.7274" y1="1296.37" x2="1688.7274"
                                    y2="1322.6567">
                                    <stop offset="0" style="stop-color:#4F96F2" />
                                    <stop offset="1" style="stop-color:#5092EB" />
                                </linearGradient>
                                <path style="fill:url(#SVGID_00000112620418654198932980000007915604808652468922_);" d="M1858.8,1299.9l0,10.3v0.2
			c0,0.5,0,1-0.1,1.4v-0.8c-1,9.6-9.2,17.1-19.1,17.1h-320.9v-28.2c21.2,0,21.2,13.6,42.5,13.6c0.7,0,1.4,0,2,0
			c19.2-0.8,19.8-13.6,40.4-13.6c21.2,0,21.2,13.6,42.5,13.6s21.2-13.6,42.5-13.6s21.2,13.6,42.5,13.6s21.2-13.6,42.5-13.6
			c21.4,0,21.4,13.6,42.6,13.6c21.3,0,21.4-13.6,42.5-13.6H1858.8z" />
                            </g>

                            <linearGradient id="SVGID_00000176733163868605016290000015759504001705176194_"
                                gradientUnits="userSpaceOnUse" x1="1822.2385" y1="459.242" x2="1759.2456" y2="459.242"
                                gradientTransform="matrix(1 0 0 -1 0 1483.7244)">
                                <stop offset="0" style="stop-color:#6D5882" />
                                <stop offset="1" style="stop-color:#484050" />
                            </linearGradient>
                            <path style="fill:url(#SVGID_00000176733163868605016290000015759504001705176194_);" d="M1822.1,1017.3c0-2.8-2.2-5-4.8-5H1789
		c-7.1,0-12.8,3.5-17.4,10.3l-10.1,14h60.7v-19.3H1822.1z" />

                            <linearGradient id="SVGID_00000137830632597748930620000008835887565362066355_"
                                gradientUnits="userSpaceOnUse" x1="1822.2385" y1="459.242" x2="1816.1669" y2="459.242"
                                gradientTransform="matrix(1 0 0 -1 0 1483.7244)">
                                <stop offset="0" style="stop-color:#836E98" />
                                <stop offset="1" style="stop-color:#836E98;stop-opacity:0" />
                            </linearGradient>
                            <path style="fill:url(#SVGID_00000137830632597748930620000008835887565362066355_);" d="M1822.1,1017.3c0-2.8-2.2-5-4.8-5H1789
		c-7.1,0-12.8,3.5-17.4,10.3l-10.1,14h60.7v-19.3H1822.1z" />

                            <linearGradient id="SVGID_00000062192789969750707240000005595628085777420972_"
                                gradientUnits="userSpaceOnUse" x1="1832.3911" y1="396.312" x2="1747.957" y2="448.5436"
                                gradientTransform="matrix(1 0 0 -1 0 1483.7244)">
                                <stop offset="0" style="stop-color:#D3D2D2" />
                                <stop offset="0.8335" style="stop-color:#FFFFFF" />
                                <stop offset="1" style="stop-color:#636363" />
                            </linearGradient>
                            <path style="fill:url(#SVGID_00000062192789969750707240000005595628085777420972_);" d="M1761.5,1036.6l-24.3,36.4h85v-36.4
		H1761.5z" />
                            <path class="st234" d="M1761.5,1036.6l-24.3,36.4h85v-36.4H1761.5z" />

                            <linearGradient id="SVGID_00000013900738389692124530000014550999730504895897_"
                                gradientUnits="userSpaceOnUse" x1="1759.0978" y1="443.0183" x2="1762.561" y2="440.6467"
                                gradientTransform="matrix(1 0 0 -1 0 1483.7244)">
                                <stop offset="0" style="stop-color:#B5B1B8" />
                                <stop offset="1" style="stop-color:#B5B1B8;stop-opacity:0" />
                            </linearGradient>
                            <path style="fill:url(#SVGID_00000013900738389692124530000014550999730504895897_);" d="M1761.5,1036.6l-24.3,36.4h85v-36.4
		H1761.5z" />

                            <linearGradient id="SVGID_00000038404400712882439960000017480896551885568691_"
                                gradientUnits="userSpaceOnUse" x1="1822.2385" y1="428.884" x2="1815.7869" y2="428.884"
                                gradientTransform="matrix(1 0 0 -1 0 1483.7244)">
                                <stop offset="0" style="stop-color:#FBF8FE" />
                                <stop offset="1" style="stop-color:#FBF8FE;stop-opacity:0" />
                            </linearGradient>
                            <path style="fill:url(#SVGID_00000038404400712882439960000017480896551885568691_);" d="M1761.5,1036.6l-24.3,36.4h85v-36.4
		H1761.5z" />
                            <g>
                                <path class="st237" d="M1667.4,1191.1h12.1c3.4,0,6.1,2.7,6.1,6.1v12.1c0,3.4-2.7,6.1-6.1,6.1h-12.1c-3.4,0-6.1-2.7-6.1-6.1v-12.1
			C1661.3,1193.8,1664.1,1191.1,1667.4,1191.1z" />
                            </g>
                            <g>
                                <path class="st237" d="M1716,1191.1h12.1c3.4,0,6.1,2.7,6.1,6.1v12.1c0,3.4-2.7,6.1-6.1,6.1H1716c-3.4,0-6.1-2.7-6.1-6.1v-12.1
			C1709.9,1193.8,1712.6,1191.1,1716,1191.1z" />
                            </g>
                            <g>
                                <path class="st237" d="M1764.6,1191.1h12.1c3.4,0,6.1,2.7,6.1,6.1v12.1c0,3.4-2.7,6.1-6.1,6.1h-12.1c-3.4,0-6.1-2.7-6.1-6.1v-12.1
			C1758.5,1193.8,1761.2,1191.1,1764.6,1191.1z" />
                            </g>
                            <g>
                                <path class="st237" d="M1813.1,1191.1h12.1c3.4,0,6.1,2.7,6.1,6.1v12.1c0,3.4-2.7,6.1-6.1,6.1h-12.1c-3.4,0-6.1-2.7-6.1-6.1v-12.1
			C1807.1,1193.8,1809.8,1191.1,1813.1,1191.1z" />
                            </g>
                            <g>
                                <path class="st237" d="M1788.8,1097.3h12.1c3.4,0,6.1,2.7,6.1,6.1v12.1c0,3.4-2.7,6.1-6.1,6.1h-12.1c-3.4,0-6.1-2.7-6.1-6.1v-12.1
			C1782.8,1100.1,1785.5,1097.3,1788.8,1097.3z" />
                            </g>
                        </g>
                        <path id="JANAH-LINE-5" class="st238" d="M1452.8,459.7c-70.1,63.6,32,389-171.5,522" />
                        <path id="JANAH-LINE-4" class="st238" d="M1617.7,1092.7c-131.1-131.1-107.5-412.8-16.9-504" />
                        <path id="JANAH-LINE-3" class="st238" d="M1177,325.1c149,0,151.5,332.4,12.3,332.4" />
                        <path id="JANAH-LINE-2" class="st238" d="M438.6,520.7c44.6-66.3,126.7-195.6,415.5-195.6" />
                        <path id="JANAH-LINE-1" class="st238" d="M579.9,1015.7c42.3-34.3,178.6-193.6-55.1-315.8" />
                    </svg>
                </div>
            </div>
        </div>
        <div class="landing-hero-blank"></div>
    </section>
    <!-- Hero: End -->

    <!-- Useful features: Start -->
    <section id="landingFeatures" class="section-py landing-features">
        <div class="container">
            <div class="text-center mb-3 pb-1">
                <span class="badge bg-label-primary">{{__('Our Services')}}</span>
            </div>
            <h3 class="text-center mb-1">
                <span class="section-title">{{__('Retailer Services for All Shipments')}}</span>
            </h3>
            <!-- <p class="text-center mb-3 mb-md-5 pb-3">
                Not just a set of tools, the package includes ready-to-deploy conceptual application.
            </p> -->
            <div class="features-icon-wrapper row gx-0 gy-4 g-sm-5">
                <div class="col-lg-4 col-md-6 text-start features-icon-box">
                    <div class="text-center mb-3">
                        <img src="{{asset('assets/img/front-pages/icons/laptop.png')}}" alt="laptop charging" />
                    </div>
                    <h5 class="mb-3 text-center">{{__('General Cargo Shipments and Containers')}}</h5>
                    <p class="features-icon-description">
                        {{__('We operate in a number of challenging destinations where we recognize our clients’ needs for reliable import and export services. No matter where the goods are travelling to or from, our goal is to provide complete customer satisfaction through consistent quality service. We manage and facilitate FCL (Full Container Load), LCL (Less Than Container load), ODC (Over Dimension Cargo) and Reefer Cargo Shipments to and from anywhere in the world')}}.
                    </p>
                </div>
                <div class="col-lg-4 col-md-6 text-start  features-icon-box">
                    <div class="text-center mb-3">
                        <img src="{{asset('assets/img/front-pages/icons/rocket.png')}}" alt="transition up" />
                    </div>
                    <h5 class="mb-3 text-center ">{{__('Oil and Gas Transportation and Logistics')}}</h5>
                    <p class="features-icon-description">
                        {{__('When it comes to managing the logistics of oil and gas, safety and efficiency are the greatest concerns. At MESC, we have extensive experience of providing specialized logistic services for this industry. We offer comprehensive management concepts and flexible solutions for all kinds of support needed')}}.
                    </p>
                </div>
                <div class="col-lg-4 col-md-6 text-start features-icon-box">
                    <div class="text-center mb-3">
                        <img src="{{asset('assets/img/front-pages/icons/paper.png')}}" alt="edit" />
                    </div>
                    <h5 class="mb-3 text-center">{{__('Dry Masonry / Cattle Transport')}}</h5>
                    <p class="features-icon-description">
                        {{__('We provide competitive prices for high quality services in Cattle/Animal Transport ( Cows, Sheep, Dears, Camels, and Horses ) , these vessels are especially designed with areas equipped with animal feeders mimicking those found in farms, with ventilation and locking systems that can be set according to the need for temperature and/or air supply, they are also equipped with automatic feeding belts, and waste disposal systems. We also provide dry masonry transport solutions with full retailer services')}}
                    </p>
                </div>
                <div class="col-lg-4 col-md-6 text-start features-icon-box">
                    <div class="text-center mb-3">
                        <img src="{{asset('assets/img/front-pages/icons/check.png')}}" alt="3d select solid" />
                    </div>
                    <h5 class="mb-3 text-center">
                        {{__('Custom Clearance / Storage & Transport / Door to Door Delivery')}}</h5>
                    <p class="features-icon-description">
                        {{__('In 2018 MESC Freight & Logistics Company began a venture with ( Alafdal Custom Clearance Services Company ).( Alafdal Company ) was established in 1990, and is one of the most renowned companies in the field')}}.
                    </p>
                </div>
                <div class="col-lg-4 col-md-6 text-start features-icon-box">
                    <div class="text-center mb-3">
                        <img src="{{asset('assets/img/front-pages/icons/user.png')}}" alt="lifebelt" />
                    </div>
                    <h5 class="mb-3 text-center">{{__('Ship Supply Services')}}</h5>
                    <p class="features-icon-description">
                        {{__('Crew Member Accomodation & Catering')}}.<br> {{__('Providing Security Liaisons')}}.<br>
                        {{__('Supervising Cargo Condition & Count')}}.<br>
                        {{__('Solutions for Heavy Lifting Utilities')}}.
                    </p>
                </div>

            </div>
        </div>
    </section>
    <!-- Useful features: End -->

    <!-- Real customers reviews: Start -->
    <section id="landingReviews" class="section-py bg-body landing-reviews pb-0">
        <!-- What people say slider: Start -->
        <div class="container">
            <div class="row align-items-center gx-0 gy-4 g-lg-5">
                <div class="col-md-6 col-lg-5 col-xl-3">
                    <div class="mb-3 pb-1">
                        <span class="badge bg-label-primary">Real Customers Reviews</span>
                    </div>
                    <h3 class="mb-1"><span class="section-title">What people say</span></h3>
                    <p class="mb-3 mb-md-5">
                        See what our customers have to<br class="d-none d-xl-block" />
                        say about their experience.
                    </p>
                    <div class="landing-reviews-btns">
                        <button id="reviews-previous-btn" class="btn btn-label-primary reviews-btn me-3 scaleX-n1-rtl"
                            type="button">
                            <i class="ti ti-chevron-left ti-sm"></i>
                        </button>
                        <button id="reviews-next-btn" class="btn btn-label-primary reviews-btn scaleX-n1-rtl"
                            type="button">
                            <i class="ti ti-chevron-right ti-sm"></i>
                        </button>
                    </div>
                </div>
                <div class="col-md-6 col-lg-7 col-xl-9">
                    <div class="swiper-reviews-carousel overflow-hidden mb-5 pb-md-2 pb-md-3">
                        <div class="swiper" id="swiper-reviews">
                            <div class="swiper-wrapper">
                                <div class="swiper-slide">
                                    <div class="card h-100">
                                        <div
                                            class="card-body text-body d-flex flex-column justify-content-between h-100">
                                            <div class="mb-3">
                                                <img src="{{asset('assets/img/front-pages/branding/logo-1.png')}}"
                                                    alt="client logo" class="client-logo img-fluid" />
                                            </div>
                                            <p>
                                                “Vuexy is hands down the most useful front end Bootstrap theme I've ever
                                                used. I can't wait
                                                to use it again for my next project.”
                                            </p>
                                            <div class="text-warning mb-3">
                                                <i class="ti ti-star-filled ti-sm"></i>
                                                <i class="ti ti-star-filled ti-sm"></i>
                                                <i class="ti ti-star-filled ti-sm"></i>
                                                <i class="ti ti-star-filled ti-sm"></i>
                                                <i class="ti ti-star-filled ti-sm"></i>
                                            </div>
                                            <div class="d-flex align-items-center">
                                                <div class="avatar me-2 avatar-sm">
                                                    <img src="{{asset('assets/img/avatars/1.png')}}" alt="Avatar"
                                                        class="rounded-circle" />
                                                </div>
                                                <div>
                                                    <h6 class="mb-0">Cecilia Payne</h6>
                                                    <p class="small text-muted mb-0">CEO of Airbnb</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="swiper-slide">
                                    <div class="card h-100">
                                        <div
                                            class="card-body text-body d-flex flex-column justify-content-between h-100">
                                            <div class="mb-3">
                                                <img src="{{asset('assets/img/front-pages/branding/logo-2.png')}}"
                                                    alt="client logo" class="client-logo img-fluid" />
                                            </div>
                                            <p>
                                                “I've never used a theme as versatile and flexible as Vuexy. It's my go
                                                to for building
                                                dashboard sites on almost any project.”
                                            </p>
                                            <div class="text-warning mb-3">
                                                <i class="ti ti-star-filled ti-sm"></i>
                                                <i class="ti ti-star-filled ti-sm"></i>
                                                <i class="ti ti-star-filled ti-sm"></i>
                                                <i class="ti ti-star-filled ti-sm"></i>
                                                <i class="ti ti-star-filled ti-sm"></i>
                                            </div>
                                            <div class="d-flex align-items-center">
                                                <div class="avatar me-2 avatar-sm">
                                                    <img src="{{asset('assets/img/avatars/2.png')}}" alt="Avatar"
                                                        class="rounded-circle" />
                                                </div>
                                                <div>
                                                    <h6 class="mb-0">Eugenia Moore</h6>
                                                    <p class="small text-muted mb-0">Founder of Hubspot</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="swiper-slide">
                                    <div class="card h-100">
                                        <div
                                            class="card-body text-body d-flex flex-column justify-content-between h-100">
                                            <div class="mb-3">
                                                <img src="{{asset('assets/img/front-pages/branding/logo-3.png')}}"
                                                    alt="client logo" class="client-logo img-fluid" />
                                            </div>
                                            <p>
                                                This template is really clean & well documented. The docs are really
                                                easy to understand and
                                                it's always easy to find a screenshot from their website.
                                            </p>
                                            <div class="text-warning mb-3">
                                                <i class="ti ti-star-filled ti-sm"></i>
                                                <i class="ti ti-star-filled ti-sm"></i>
                                                <i class="ti ti-star-filled ti-sm"></i>
                                                <i class="ti ti-star-filled ti-sm"></i>
                                                <i class="ti ti-star-filled ti-sm"></i>
                                            </div>
                                            <div class="d-flex align-items-center">
                                                <div class="avatar me-2 avatar-sm">
                                                    <img src="{{asset('assets/img/avatars/3.png')}}" alt="Avatar"
                                                        class="rounded-circle" />
                                                </div>
                                                <div>
                                                    <h6 class="mb-0">Curtis Fletcher</h6>
                                                    <p class="small text-muted mb-0">Design Lead at Dribbble</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="swiper-slide">
                                    <div class="card h-100">
                                        <div
                                            class="card-body text-body d-flex flex-column justify-content-between h-100">
                                            <div class="mb-3">
                                                <img src="{{asset('assets/img/front-pages/branding/logo-4.png')}}"
                                                    alt="client logo" class="client-logo img-fluid" />
                                            </div>
                                            <p>
                                                All the requirements for developers have been taken into consideration,
                                                so I’m able to build
                                                any interface I want.
                                            </p>
                                            <div class="text-warning mb-3">
                                                <i class="ti ti-star-filled ti-sm"></i>
                                                <i class="ti ti-star-filled ti-sm"></i>
                                                <i class="ti ti-star-filled ti-sm"></i>
                                                <i class="ti ti-star-filled ti-sm"></i>
                                                <i class="ti ti-star ti-sm"></i>
                                            </div>
                                            <div class="d-flex align-items-center">
                                                <div class="avatar me-2 avatar-sm">
                                                    <img src="{{asset('assets/img/avatars/4.png')}}" alt="Avatar"
                                                        class="rounded-circle" />
                                                </div>
                                                <div>
                                                    <h6 class="mb-0">Sara Smith</h6>
                                                    <p class="small text-muted mb-0">Founder of Continental</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="swiper-slide">
                                    <div class="card h-100">
                                        <div
                                            class="card-body text-body d-flex flex-column justify-content-between h-100">
                                            <div class="mb-3">
                                                <img src="{{asset('assets/img/front-pages/branding/logo-5.png')}}"
                                                    alt="client logo" class="client-logo img-fluid" />
                                            </div>
                                            <p>
                                                “I've never used a theme as versatile and flexible as Vuexy. It's my go
                                                to for building
                                                dashboard sites on almost any project.”
                                            </p>
                                            <div class="text-warning mb-3">
                                                <i class="ti ti-star-filled ti-sm"></i>
                                                <i class="ti ti-star-filled ti-sm"></i>
                                                <i class="ti ti-star-filled ti-sm"></i>
                                                <i class="ti ti-star-filled ti-sm"></i>
                                                <i class="ti ti-star-filled ti-sm"></i>
                                            </div>
                                            <div class="d-flex align-items-center">
                                                <div class="avatar me-2 avatar-sm">
                                                    <img src="{{asset('assets/img/avatars/5.png')}}" alt="Avatar"
                                                        class="rounded-circle" />
                                                </div>
                                                <div>
                                                    <h6 class="mb-0">Eugenia Moore</h6>
                                                    <p class="small text-muted mb-0">Founder of Hubspot</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="swiper-slide">
                                    <div class="card h-100">
                                        <div
                                            class="card-body text-body d-flex flex-column justify-content-between h-100">
                                            <div class="mb-3">
                                                <img src="{{asset('assets/img/front-pages/branding/logo-6.png')}}"
                                                    alt="client logo" class="client-logo img-fluid" />
                                            </div>
                                            <p>
                                                Lorem ipsum dolor sit amet consectetur adipisicing elit. Veniam nemo
                                                mollitia, ad eum
                                                officia numquam nostrum repellendus consequuntur!
                                            </p>
                                            <div class="text-warning mb-3">
                                                <i class="ti ti-star-filled ti-sm"></i>
                                                <i class="ti ti-star-filled ti-sm"></i>
                                                <i class="ti ti-star-filled ti-sm"></i>
                                                <i class="ti ti-star-filled ti-sm"></i>
                                                <i class="ti ti-star ti-sm"></i>
                                            </div>
                                            <div class="d-flex align-items-center">
                                                <div class="avatar me-2 avatar-sm">
                                                    <img src="{{asset('assets/img/avatars/1.png')}}" alt="Avatar"
                                                        class="rounded-circle" />
                                                </div>
                                                <div>
                                                    <h6 class="mb-0">Sara Smith</h6>
                                                    <p class="small text-muted mb-0">Founder of Continental</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="swiper-button-next"></div>
                            <div class="swiper-button-prev"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- What people say slider: End -->
        <hr class="m-0" />
        <!-- Logo slider: Start -->
        <div class="container">
            <div class="swiper-logo-carousel py-4 my-lg-2">
                <div class="swiper" id="swiper-clients-logos">
                    <div class="swiper-wrapper">
                        <div class="swiper-slide">
                            <img src="{{asset('assets/img/front-pages/branding/logo_1-'.$configData['style'].'.png') }}"
                                alt="client logo" class="client-logo"
                                data-app-light-img="front-pages/branding/logo_1-light.png"
                                data-app-dark-img="front-pages/branding/logo_1-dark.png" />
                        </div>
                        <div class="swiper-slide">
                            <img src="{{asset('assets/img/front-pages/branding/logo_2-'.$configData['style'].'.png') }}"
                                alt="client logo" class="client-logo"
                                data-app-light-img="front-pages/branding/logo_2-light.png"
                                data-app-dark-img="front-pages/branding/logo_2-dark.png" />
                        </div>
                        <div class="swiper-slide">
                            <img src="{{asset('assets/img/front-pages/branding/logo_3-'.$configData['style'].'.png') }}"
                                alt="client logo" class="client-logo"
                                data-app-light-img="front-pages/branding/logo_3-light.png"
                                data-app-dark-img="front-pages/branding/logo_3-dark.png" />
                        </div>
                        <div class="swiper-slide">
                            <img src="{{asset('assets/img/front-pages/branding/logo_4-'.$configData['style'].'.png') }}"
                                alt="client logo" class="client-logo"
                                data-app-light-img="front-pages/branding/logo_4-light.png"
                                data-app-dark-img="front-pages/branding/logo_4-dark.png" />
                        </div>
                        <div class="swiper-slide">
                            <img src="{{asset('assets/img/front-pages/branding/logo_5-'.$configData['style'].'.png') }}"
                                alt="client logo" class="client-logo"
                                data-app-light-img="front-pages/branding/logo_5-light.png"
                                data-app-dark-img="front-pages/branding/logo_5-dark.png" />
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Logo slider: End -->
    </section>
    <!-- Real customers reviews: End -->

    <!-- Our great team: Start -->
    <!-- <section id="landingTeam" class="section-py landing-team">
        <div class="container">
            <div class="text-center mb-3 pb-1">
                <span class="badge bg-label-primary">Our Great Team</span>
            </div>
            <h3 class="text-center mb-1"><span class="section-title">Supported</span> by Real People</h3>
            <p class="text-center mb-md-5 pb-3">Who is behind these great-looking interfaces?</p>
            <div class="row gy-5 mt-2">
                <div class="col-lg-3 col-sm-6">
                    <div class="card mt-3 mt-lg-0 shadow-none">
                        <div class="bg-label-primary position-relative team-image-box">
                            <img src="{{asset('assets/img/front-pages/landing-page/team-member-1.png')}}"
                                class="position-absolute card-img-position bottom-0 start-50 scaleX-n1-rtl"
                                alt="human image" />
                        </div>
                        <div class="card-body border border-top-0 border-label-primary text-center">
                            <h5 class="card-title mb-0">Sophie Gilbert</h5>
                            <p class="text-muted mb-0">Project Manager</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6">
                    <div class="card mt-3 mt-lg-0 shadow-none">
                        <div class="bg-label-info position-relative team-image-box">
                            <img src="{{asset('assets/img/front-pages/landing-page/team-member-2.png')}}"
                                class="position-absolute card-img-position bottom-0 start-50 scaleX-n1-rtl"
                                alt="human image" />
                        </div>
                        <div class="card-body border border-top-0 border-label-info text-center">
                            <h5 class="card-title mb-0">Paul Miles</h5>
                            <p class="text-muted mb-0">UI Designer</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6">
                    <div class="card mt-3 mt-lg-0 shadow-none">
                        <div class="bg-label-danger position-relative team-image-box">
                            <img src="{{asset('assets/img/front-pages/landing-page/team-member-3.png')}}"
                                class="position-absolute card-img-position bottom-0 start-50 scaleX-n1-rtl"
                                alt="human image" />
                        </div>
                        <div class="card-body border border-top-0 border-label-danger text-center">
                            <h5 class="card-title mb-0">Nannie Ford</h5>
                            <p class="text-muted mb-0">Development Lead</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6">
                    <div class="card mt-3 mt-lg-0 shadow-none">
                        <div class="bg-label-success position-relative team-image-box">
                            <img src="{{asset('assets/img/front-pages/landing-page/team-member-4.png')}}"
                                class="position-absolute card-img-position bottom-0 start-50 scaleX-n1-rtl"
                                alt="human image" />
                        </div>
                        <div class="card-body border border-top-0 border-label-success text-center">
                            <h5 class="card-title mb-0">Chris Watkins</h5>
                            <p class="text-muted mb-0">Marketing Manager</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section> -->
    <!-- Our great team: End -->

    <!-- Fun facts: Start -->
    <section id="landingFunFacts" class="section-py landing-fun-facts">
        <div class="container">
            <div class="row gy-3">
                <div class="col-sm-6 col-lg-3">
                    <div class="card border border-label-primary shadow-none">
                        <div class="card-body text-center">
                            <img src="{{asset('assets/img/front-pages/icons/laptop.png')}}" alt="laptop" class="mb-2" />
                            <h5 class="h2 mb-1">7.1k+</h5>
                            <p class="fw-medium mb-0">
                                Support Tickets<br />
                                Resolved
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-lg-3">
                    <div class="card border border-label-success shadow-none">
                        <div class="card-body text-center">
                            <img src="{{asset('assets/img/front-pages/icons/user-success.png')}}" alt="laptop"
                                class="mb-2" />
                            <h5 class="h2 mb-1">50k+</h5>
                            <p class="fw-medium mb-0">
                                Join creatives<br />
                                community
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-lg-3">
                    <div class="card border border-label-info shadow-none">
                        <div class="card-body text-center">
                            <img src="{{asset('assets/img/front-pages/icons/diamond-info.png')}}" alt="laptop"
                                class="mb-2" />
                            <h5 class="h2 mb-1">4.8/5</h5>
                            <p class="fw-medium mb-0">
                                Highly Rated<br />
                                Products
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-lg-3">
                    <div class="card border border-label-warning shadow-none">
                        <div class="card-body text-center">
                            <img src="{{asset('assets/img/front-pages/icons/check-warning.png')}}" alt="laptop"
                                class="mb-2" />
                            <h5 class="h2 mb-1">100%</h5>
                            <p class="fw-medium mb-0">
                                Money Back<br />
                                Guarantee
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Fun facts: End -->

    <!-- FAQ: Start -->
    <section id="landingFAQ" class="section-py bg-body landing-faq">
        <div class="container">
            <div class="text-center mb-3 pb-1">
                <span class="badge bg-label-primary">{{__('FAQ')}}</span>
            </div>
            <h3 class="text-center mb-1"><span class="section-title">{{__('Frequently asked questions')}}</span></h3>
            <!-- <p class="text-center mb-5 pb-3">Browse through these FAQs to find answers to commonly asked questions.</p> -->
            <div class="row gy-5">
                <div class="col-lg-5">
                    <div class="text-center">
                        <img src="{{asset('assets/img/front-pages/landing-page/faq-boy-with-logos.png')}}"
                            alt="faq boy with logos" class="faq-image" />
                    </div>
                </div>
                <div class="col-lg-7">
                    <div class="accordion" id="accordionExample">
                        <div class="card accordion-item active">
                            <h2 class="accordion-header" id="headingOne">
                                <button type="button" class="accordion-button" data-bs-toggle="collapse"
                                    data-bs-target="#accordionOne" aria-expanded="true" aria-controls="accordionOne">
                                    {{__('What are the characteristics of ( roll on / roll off ) ships?')}}
                                </button>
                            </h2>

                            <div id="accordionOne" class="accordion-collapse collapse show"
                                data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    {{__('Ro-Ro ships are vessels designed to transport vehicles on wheels, i.e. cars, trucks or industrial vehicles. Sometimes they have built-in ramps for the loading and unloading of vehicles. The fact that the cargo can access the ship under its own steam removes the need for a crane, thus reducing the intermediary costs related to loading, unloading and stowage. These ships can only carry wheeled vehicles and mustn’t be confused with Ro-Pax vessels, like ferries, which combine the transport of vehicles and passengers')}}
                                </div>
                            </div>
                        </div>
                        <div class="card accordion-item">
                            <h2 class="accordion-header" id="headingTwo">
                                <button type="button" class="accordion-button collapsed" data-bs-toggle="collapse"
                                    data-bs-target="#accordionTwo" aria-expanded="false" aria-controls="accordionTwo">
                                    {{__('What is the purpose of a ( roll on / roll off ) ship?')}}
                                </button>
                            </h2>
                            <div id="accordionTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo"
                                data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    {{__('To transport wheeled cargo, such as all kinds of vehicles and machinary with wheels. The cargo can be loaded using the ramp, with no need for cranes or intermediaries, thereby making for lower costs and risks')}}
                                </div>
                            </div>
                        </div>
                        <div class="card accordion-item">
                            <h2 class="accordion-header" id="headingThree">
                                <button type="button" class="accordion-button collapsed" data-bs-toggle="collapse"
                                    data-bs-target="#accordionThree" aria-expanded="false"
                                    aria-controls="accordionThree">
                                    {{__('What are container ships?')}}
                                </button>
                            </h2>
                            <div id="accordionThree" class="accordion-collapse collapse" aria-labelledby="headingThree"
                                data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    {{__('Vessels designed to transport freight in containers. They monopolize the majority of international dry cargo transport and represent more than half of all maritime trade. They are intended to transport standard containers according to ISO regulations')}}.
                                </div>
                            </div>
                        </div>
                        <div class="card accordion-item">
                            <h2 class="accordion-header" id="headingFour">
                                <button type="button" class="accordion-button collapsed" data-bs-toggle="collapse"
                                    data-bs-target="#accordionFour" aria-expanded="false" aria-controls="accordionFour">
                                    {{__('What is a ship agent?')}}
                                </button>
                            </h2>
                            <div id="accordionFour" class="accordion-collapse collapse" aria-labelledby="headingFour"
                                data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    {{__('A ship agent is an independent shipping agent who acts on behalf of the ship owner. Ship agents are responsible for a ship when it comes into port and conduct all of the procedures required to streamline its dock time in order to reduce the cost of the operation')}}.
                                </div>
                            </div>
                        </div>
                        <div class="card accordion-item">
                            <h2 class="accordion-header" id="headingFive">
                                <button type="button" class="accordion-button collapsed" data-bs-toggle="collapse"
                                    data-bs-target="#accordionFive" aria-expanded="false" aria-controls="accordionFive">
                                    {{__('What is multimodal freight transport?')}}
                                </button>
                            </h2>
                            <div id="accordionFive" class="accordion-collapse collapse" aria-labelledby="headingFive"
                                data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    {{__('Multimodal transport consists of carrying a single cargo by different modes of transport (air, land, ocean…) using Intermodal Transport Units (ITU) such as containers, semi-trailers or swap bodies (interchangeable containers)')}}
                                </div>
                            </div>
                        </div>
                        <div class="card accordion-item">
                            <h2 class="accordion-header" id="headingSix">
                                <button type="button" class="accordion-button collapsed" data-bs-toggle="collapse"
                                    data-bs-target="#accordionSix" aria-expanded="false" aria-controls="accordionSix">
                                    {{__('What is the difference between a forwarding and a customs agent?')}}
                                </button>
                            </h2>
                            <div id="accordionSix" class="accordion-collapse collapse" aria-labelledby="headingSix"
                                data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    {{__('A forwarding agent or forwarder is a transport operator. They act on behalf and in favour of importers and exporters, organising safe, efficient and economical goods transport. In other words, a professional expert at your disposal for the purposes of hiring transport, selecting the most efficient route, taking out insurance policies, choosing the appropriate packaging and taking care of storage where required. A customs agent is responsible for managing all customs duties and documents required by the tax administration in every country for the traffic of goods between states. Their importance lies in knowing the legal regulations in order to satisfy the tax authorities and avoid last-minute surprises such as tax duties or surcharges')}}.
                                </div>
                            </div>
                        </div>
                        <div class="card accordion-item">
                            <h2 class="accordion-header" id="headingSeven">
                                <button type="button" class="accordion-button collapsed" data-bs-toggle="collapse"
                                    data-bs-target="#accordionSeven" aria-expanded="false"
                                    aria-controls="accordionSeven">
                                    {{__('How do customs controls work?')}}
                                </button>
                            </h2>
                            <div id="accordionSeven" class="accordion-collapse collapse" aria-labelledby="headingSeven"
                                data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    <ol>
                                        <li>{{__('Customs declaration: Must be presented to the customs authority in order to identify the goods to be transported and their destination')}}.
                                        </li>
                                        <li>{{__('Goods inspection by the customs agents, to check that they match the declaration')}}.
                                        </li>
                                        <li>{{__('Verification that trade policy norms have been met and amounts due have been paid (import and export duties)')}}
                                        </li>
                                    </ol>

                                </div>
                            </div>
                        </div>
                        <div class="card accordion-item">
                            <h2 class="accordion-header" id="headingEight">
                                <button type="button" class="accordion-button collapsed" data-bs-toggle="collapse"
                                    data-bs-target="#accordionEight" aria-expanded="false"
                                    aria-controls="accordionEight">
                                    {{__('What is the purpose of international customs?')}}
                                </button>
                            </h2>
                            <div id="accordionEight" class="accordion-collapse collapse" aria-labelledby="headingEight"
                                data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    {{__('The role of customs control is to regulate and inspect shipments in order to guarantee that commercial exchanges between different countries proceed legally, that they comply with all tax and duty obligations and with all other requirements related to their entry or exit. As well as guaranteeing compliance with international trade rules, collecting taxes and duties due where appropriate, customs controls are a fundamental mechanism for preventing money laundering, tax fraud and drug trafficking')}}
                                </div>
                            </div>
                        </div>
                        <div class="card accordion-item">
                            <h2 class="accordion-header" id="headingNine">
                                <button type="button" class="accordion-button collapsed" data-bs-toggle="collapse"
                                    data-bs-target="#accordionNine" aria-expanded="false" aria-controls="accordionNine">
                                    {{__('What is customs management?')}}
                                </button>
                            </h2>
                            <div id="accordionNine" class="accordion-collapse collapse" aria-labelledby="headingNine"
                                data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    {{__('The management of all formalities required by the customs authorities. It is important for these formalities to run smoothly and trouble-free in order to prevent delays due to bureaucratic issues. These formalities are therefore usually entrusted to a customs agent who will carry them out on behalf of the freight owner')}}.
                                </div>
                            </div>
                        </div>
                        <div class="card accordion-item">
                            <h2 class="accordion-header" id="headingTen">
                                <button type="button" class="accordion-button collapsed" data-bs-toggle="collapse"
                                    data-bs-target="#accordionTen" aria-expanded="false" aria-controls="accordionTen">
                                    {{__('What is customs clearance?')}}
                                </button>
                            </h2>
                            <div id="accordionTen" class="accordion-collapse collapse" aria-labelledby="headingTen"
                                data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    {{__('All formalities and requirements to be completed for goods entering and leaving a specific national territory in order to control and approve their transportation. The customs agent is responsible for completing these formalities on behalf of the importer or exporter, and for submitting a declaration of information to the competent customs authority in each case')}}.
                                </div>
                            </div>
                        </div>
                        <div class="card accordion-item">
                            <h2 class="accordion-header" id="headingEleven">
                                <button type="button" class="accordion-button collapsed" data-bs-toggle="collapse"
                                    data-bs-target="#accordionEleven" aria-expanded="false"
                                    aria-controls="accordionEleven">
                                    {{__('What is completed customs clearance?')}}
                                </button>
                            </h2>
                            <div id="accordionEleven" class="accordion-collapse collapse"
                                aria-labelledby="headingEleven" data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    {{__('Customs clearance means that the customs procedure has been completed, i.e. that all of the paperwork has been submitted and that the shipment can continue on its way')}}.
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- FAQ: End -->

    <!-- CTA: Start -->
    <section id="landingCTA" class="section-py landing-cta p-lg-0 pb-0">
        <div class="container">
            <div class="row align-items-center gy-5 gy-lg-0">
                <div class="col-lg-6 text-center text-lg-start">
                    <h6 class="h2 fw-bold mb-1">{{__('Explore Our Competitive Shipping Prices')}}!</h6>
                    <p class="fw-medium mb-4">
                        {{__('Embark on a journey of convenience and cost transparency. Click below to unveil our competitive shipment prices and experience hassle-free logistics tailored just for you')}}.
                    </p>
                    <a href="{{route('shipment-price')}}" class="btn btn-lg btn-primary">{{__('Shipping Price')}}</a>
                </div>
                <div class="col-lg-6 pt-lg-5 text-center text-lg-end">
                    <img src="{{asset('assets/img/front-pages/landing-page/cta-dashboard.png')}}" alt="cta dashboard"
                        class="img-fluid" />
                </div>
            </div>
        </div>
    </section>
    <!-- CTA: End -->

    <!-- Contact Us: Start -->
    <section id="landingContact" class="section-py bg-body landing-contact">
        <div class="container">
            <div class="text-center mb-3 pb-1">
                <span class="badge bg-label-primary">{{__('Contact US')}}</span>
            </div>
            <h3 class="text-center mb-1"><span class="section-title">{{__("Let's work")}}</span> {{__('together')}}</h3>
            <p class="text-center mb-4 mb-lg-5 pb-md-3">{{__('Any question or remark? just write us a message')}}</p>
            <div class="row gy-4">
                <div class="col-lg-5">
                    <div class="contact-img-box position-relative border p-2 h-100">
                        <img src="{{asset('assets/img/front-pages/landing-page/contact-customer-service.png')}}"
                            alt="contact customer service" class="contact-img w-100 scaleX-n1-rtl" />
                        <div class="pt-3 px-4 pb-1">
                            <div class="row gy-3 gx-md-4">
                                <div class="col-md-6 col-lg-12 col-xl-6">
                                    <div class="d-flex align-items-center">
                                        <div class="badge bg-label-primary rounded p-2 me-2"><i
                                                class="ti ti-mail ti-sm"></i></div>
                                        <div>
                                            <p class="mb-0">{{__('Email')}}</p>
                                            <h5 class="mb-0">
                                                <a href="mailto:example@gmail.com"
                                                    class="text-heading">example@gmail.com</a>
                                            </h5>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 col-lg-12 col-xl-6">
                                    <div class="d-flex align-items-center">
                                        <div class="badge bg-label-success rounded p-2 me-2">
                                            <i class="ti ti-phone-call ti-sm"></i>
                                        </div>
                                        <div>
                                            <p class="mb-0">{{__('Phone')}}</p>
                                            <h5 class="mb-0"><a href="tel:+1234-568-963" class="text-heading">+1234 568
                                                    963</a></h5>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-7">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="mb-1">{{__('Send a message')}}</h4>
                            <p class="mb-4">
                                {{__('If you would like to discuss anything related to shipping, prices, tracking, partnerships,')}}<br
                                    class="d-none d-lg-block" />
                                {{__('or have pre-shipping questions, you’re at the right place')}}.
                            </p>
                            <form>
                                <div class="row g-3">
                                    <div class="col-md-6">
                                        <label class="form-label"
                                            for="contact-form-fullname">{{__('Full Name')}}</label>
                                        <input type="text" class="form-control" id="contact-form-fullname"
                                            placeholder="john" />
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label" for="contact-form-email">{{__('Email')}}</label>
                                        <input type="text" id="contact-form-email" class="form-control"
                                            placeholder="johndoe@gmail.com" />
                                    </div>
                                    <div class="col-12">
                                        <label class="form-label" for="contact-form-message">{{__('Message')}}</label>
                                        <textarea id="contact-form-message" class="form-control" rows="8"
                                            placeholder="Write a message"></textarea>
                                    </div>
                                    <div class="col-12">
                                        <button type="submit" class="btn btn-primary">{{__('Send now')}}</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Contact Us: End -->
</div>
@endsection
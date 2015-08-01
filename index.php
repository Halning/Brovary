
<!----------------------------------------------------------------------------->
<?php
if (!filter_input(INPUT_SERVER, 'HTTP_X_PJAX', FILTER_VALIDATE_BOOLEAN)) {
    include 'header.php';
}
?>

<div id="middle">
    <!----------------------------------------------------------------------------->
    <div id="services">
        <div id="servicesFirst">Услуги</div>
        <div id="servicesSecond"></div>
        <div id="servicesThird"></div>
        <div id="servicesFourth"></div>
    </div>

    <div id="goods">
        <div id="goodsFirst">Товары</div>
        <div id="goodsSecond"></div>
        <div id="goodsThird"></div>
        <div id="goodsFourth"></div>
    </div>

    <div id="work">
        <div id="workFirst">Работа</div>
        <div id="workSecond"></div>
        <div id="workThird"></div>
        <div id="workFourth"></div>
    </div>

    <div id="organization">
        <div id="organizationFirst">Организации</div>
        <div id="organizationSecond"></div>
        <div id="organizationThird"></div>
        <div id="organizationFourth"></div>
    </div>

    <div id="domBack">
        <hr><div class="borderSpan">
            <span id="firstSpan"></span>
            <img class="rightImgShow" src="images/right.png">
            <span></span>
            <img class="rightImgShow" src="images/right.png">
            <span></span>
            <img class="rightImgShow" src="images/right.png">
            <span></span>
            <div id="goBack">
            </div>
        </div><hr>
    </div>

    <!----------------------------------------------------------------------------->

    <div id="domShow">
        <div class="table" id="table1"><a></a></div>
        <div class="table" id="table2"><a></a></div>
        <div class="table" id="table3"><a></a></div>
        <div class="table" id="table4"><a></a></div>

        <div  class="advertising" id="advS1">
            <div id="slider1" class="slider_wrap">		
                <img alt="Image 1" src="/images/adv.jpg" >
                <img alt="Image 2" src="/images/adv1.jpg" >
                <img alt="Image 3" src="/images/adv2.jpg" >
            </div>
        </div>

        <div class="table" id="table5"><a></a></div>
        <div class="table" id="table6"><a></a></div>
        <div class="table" id="table7"><a></a></div>


        <div class="nextPage">
            <div id="imgNextPage"></div>
        </div>
        <div class="table" id="table8"><a></a></div>
        <div class="table" id="table9"><a></a></div>
        <div class="table" id="table10"><a></a></div>
        <div class="table" id="table11"><a></a></div>


        <div  class="advertising" id="advS2">
            <div id="slider2" class="slider_wrap">		
                <img alt="Image 1" src="/images/adv.jpg" >
                <img alt="Image 2" src="/images/adv1.jpg" >
                <img alt="Image 3" src="/images/adv2.jpg" >
            </div>
        </div>

        <div class="table" id="table12"><a></a></div>
        <div class="table" id="table13"><a></a></div>
        <div class="table" id="table14"><a></a></div>


        <div class="nextPage">
            <div id="imgBeforePage"></div>
        </div>
    </div>
</div>


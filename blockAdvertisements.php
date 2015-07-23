
<?php
session_start();
if (!$_SERVER['HTTP_X_PJAX']) {
    include 'header.php';
    echo 'Не работает';
}
?>




<div id="middle">


    <!----------------------------------------------------------------------------->

    <div id="domBackBA">

        <hr><div id="back"><a href="/index.php">Назад</a></div>
        <div id="borderSpanBA">

            <span id="firstSpanBA"></span>
            <img class="rightImgShowBA" src="images/right.png"/>
            <span></span>
            <img class="rightImgShowBA" src="images/right.png"/>
            <span></span>
            <br><span id="lastSpan"></span>
            <div id="goBackBA">
            </div>
        </div><hr>

    </div>

    <!----------------------------------------------------------------------------->

    <div id="domShowBA">
        <div class="tableBA" id="tableBA1" ><a></a></div>
        <div class="tableBA" id="tableBA2"><a></a></div>
        <div class="tableBA" id="tableBA3" ><a></a></div>
        <div class="tableBA" id="tableBA4" ><a></a></div>

        <div  class="advertising" id="advS1">
            <div id="slider1" class="slider_wrap">		
                <img alt="Image 1" class="active" src="/images/adv.jpg" />
                <img alt="Image 2" src="/images/adv1.jpg" />
                <img alt="Image 3" src="/images/adv2.jpg" />
            </div>
        </div>

        <div class="tableBA" id="tableBA5"><a></a></div>
        <div class="tableBA" id="tableBA6"><a></a></div>
        <div class="tableBA" id="tableBA7"><a></a></div>


        <div id="nextPageBA">
            <div id="imgNextPageBA"></div>
        </div>
        <div class="tableBA" id="tableBA8"><a></a></div>
        <div class="tableBA" id="tableBA9"><a></a></div>
        <div class="tableBA" id="tableBA10"><a></a></div>
        <div class="tableBA" id="tableBA11"><a></a></div>


        <div  class="advertising" id="advS2">
            <div id="slider2" class="slider_wrap">		
                <img alt="Image 1" class="active" src="/images/adv.jpg" />
                <img alt="Image 2" src="/images/adv1.jpg" />
                <img alt="Image 3" src="/images/adv2.jpg" />
            </div>
        </div>

        <div class="tableBA" id="tableBA12"><a></a></div>
        <div class="tableBA" id="tableBA13"><a></a></div>
        <div class="tableBA" id="tableBA14"><a></a></div>


        <div id="nextPageBA">
            <div id="imgBeforePageBA"></div>
        </div>
    </div>


    <!----------------------------------------------------------------------------->


    <div id="look">
        <div class="lookImg">Вид:</div>
        <img class="lookImg" id="lookList" src="/images/up.jpg" title="Список"/> 
        <img class="lookImg" id="lookTile" src="/images/up.jpg" title="Плитка"/> 
    </div>
    <div id="cost">
        <form action="select1.php" method="post">

            <input class="setingsCostBA" type="text" placeholder="Цена от (грн.)" name="setingsCostD">
            <input class="setingsCostBA" type="text" placeholder="Цена до (грн.)" name="setingsCostU">
            <select class="ssCBA" size="1" name="costD">
                <option value="10">от 10 грн.
                <option value="100">от 100 грн.
                <option value="300">от 300 грн.
                <option value="1000">от 1000 грн.
            </select>

            <select class="ssCBA" size="1" name="costU">
                <option value="100">до 100 грн.
                <option value="1000">до 1000 грн.
                <option value="3000">до 3000 грн.
                <option value="10000">до 10000 грн.
            </select>

        </form>
    </div>
    <div id="sorting">
        Сортировка:
        <form action="select1.php" method="post">
            <select class="ssCBA" size="1" name="costU">
                <option value="youngest">Новые
                <option value="oldest">Старые
                <option value="3000">до 3000 грн.
                <option value="10000">до 10000 грн.
            </select>
        </form>

    </div>

    <!---------------------------------------------------------------------------> 

    <div id="middleBA">
        <div class="listings" id="listFirst"><hr>

            <img id="listImg" src="/images/nout3.jpg"/>
            <a id="listName" href="#"><strong>Ноут борзый</strong></a>
            <span>1999 грн.</span>
            <br><br><br><br id="lastBr"><span>В избранное</span>
            <p>Сегодня 22:00</p>

        </div>
    </div>      

    <!---------------------------------------------------------------------------> 

    <div id="pagesConteiner"><hr>
        <a id="pagePrev" class="prevNext" href="#"><strong><<Предыдущая</strong></a>
        <div class="pages" id="pageOne"><a href="#1"><strong>1</strong></a></div>
        <div class="pages" ><a href="#2"><strong>2</strong></a></div>
        <div class="pages" ><a href="#3"><strong>3</strong></a></div>
        <div class="pages" ><a href="#4"><strong>4</strong></a></div>
        <div class="pages" ><a href="#5"><strong>5</strong></a></div>
        <div class="pages" ><a href="#6"><strong>6</strong></a></div>
        <div class="pages" ><a href="#7"><strong>7</strong></a></div>
        <div class="pages" ><a href="#8"><strong>8</strong></a></div>
        <div class="pages" ><a href="#9"><strong>9</strong></a></div>
        <div class="pages" ><a href="#10"><strong>10</strong></a></div>
        <div class="pages" ><a href="#11"><strong>11</strong></a></div>
        <div class="pages" ><a href="#12"><strong>12</strong></a></div>
        <div class="pages" ><a href="#13"><strong>13</strong></a></div>
        <div class="pages" ><a href="#14"><strong>14</strong></a></div>
        <div class="pages" ><a href="#15"><strong>15</strong></a></div>
        <div class="pages"><a href="#16"><strong>16</strong></a></div>
        <div class="pages" ><a href="#17"><strong>17</strong></a></div>
        <div class="pages" ><a href="#18"><strong>18</strong></a></div>
        <div class="pages" ><a href="#19"><strong>19</strong></a></div>
        <div class="pages" ><a href="#20"><strong>20</strong></a></div>
        <div class="pages" ><a href="#21"><strong>21</strong></a></div>
        <div class="pages" ><a href="#22"><strong>22</strong></a></div>

        <a id="pageNext" class="prevNext" href="#"><strong>Следующая>></strong></a>
        <hr>
    </div>

    <script type="text/javascript">
        var $section = '<?php
$section = htmlspecialchars($_GET['section']);
echo $section;
?>';
        var $name = '<?php
$name = htmlspecialchars($_GET['name']);
echo $name;
?>';
    </script>
</div>



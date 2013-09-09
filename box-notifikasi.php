<!-- Notification box starts -->
<div class="slide-box">

    <!-- Notification box head -->
    <div class="slide-box-head bred">
        <!-- Title -->
        <div class="pull-left">Notification Box</div>          
        <!-- Icon -->
        <div class="slide-icons pull-right">
            <a href="#" class="sminimize"><i class="icon-chevron-down"></i></a> 
            <a href="#" class="sclose"><i class="icon-remove"></i></a>
        </div>
        <div class="clearfix"></div>
    </div>

    <div class="slide-content">

        <!-- It is default bootstrap nav tabs. See official bootstrap doc for doubts -->
        <ul class="nav nav-tabs">
            <!-- Tab links -->
            <li class="active"><a href="#tab1" data-toggle="tab"><i class="icon-bar-chart"></i></a></li>
            <li><a href="#tab2" data-toggle="tab"><i class="icon-phone"></i></a></li>
            <li><a href="#tab3" data-toggle="tab"><i class="icon-comments"></i></a></li>
        </ul>

        <!-- Tab content -->

        <div class="tab-content">

            <div class="tab-pane active" id="tab1">

                <!-- Graph #1 -->
                <div class="slide-data">
                    <div class="slide-data-text">Today Earnings</div>
                    <div class="slide-data-result">$5,0000 <i class="icon-arrow-up red"></i> </div>
                    <div class="clearfix"></div>
                    <hr />
                    <span id="todayspark4" class="spark"></span>
                </div>

                <!-- Graph #2 -->
                <div class="slide-data">
                    <div class="slide-data-text">Yesterday Earnings</div>
                    <div class="slide-data-result">$4,6000 <i class="icon-arrow-down green"></i> </div>
                    <div class="clearfix"></div>
                    <hr />
                    <span id="todayspark5" class="spark"></span>
                </div>                

            </div>

            <div class="tab-pane" id="tab2">
                <h5>Have some content here.</h5>
                <p>Aliquam dui libero, pharetra nec venenatis in, scelerisque quis odio. In hac habitasse platea dictumst. Etiam porta placerat turpis, eget fermentum neque egestas at. Vestibulum ullamcorper, augue a sollicitudin vestibulum, orci purus semper felis, lobortis consequat nisi nunc eu enim. </p>
            </div>

            <div class="tab-pane" id="tab3">
                <h5>Have some content here.</h5>
                <p>Aliquam dui libero, pharetra nec venenatis in, scelerisque quis odio. In hac habitasse platea dictumst. Etiam porta placerat turpis, eget fermentum neque egestas at. Vestibulum ullamcorper, augue a sollicitudin vestibulum, orci purus semper felis, lobortis consequat nisi nunc eu enim.</p>
            </div>              

        </div>

    </div>

</div> 
<!-- Notification box ends -->

<script>
    /* Notification box */
    $('.slide-box-head').click(function() {
        var $slidebtn = $(this);
        var $slidebox = $(this).parent().parent();
        if ($slidebox.css('right') == "-252px") {
            $slidebox.animate({
                right: 0
            }, 500);
            $slidebtn.children("i").removeClass().addClass("icon-chevron-right");
        }
        else {
            $slidebox.animate({
                right: -252
            }, 500);
            $slidebtn.children("i").removeClass().addClass("icon-chevron-left");
        }
    });


    $('.sclose').click(function(e) {
        e.preventDefault();
        var $wbox = $(this).parent().parent().parent();
        $wbox.hide(0);
    });


    $('.sminimize').click(function(e) {
        e.preventDefault();
        var $wcontent = $(this).parent().parent().next('.slide-content');
        if ($wcontent.is(':visible'))
        {
            $(this).children('i').removeClass('icon-chevron-down');
            $(this).children('i').addClass('icon-chevron-up');
        }
        else
        {
            $(this).children('i').removeClass('icon-chevron-up');
            $(this).children('i').addClass('icon-chevron-down');
        }
        $wcontent.toggle(0);
    });
</script>

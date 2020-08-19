<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-12">
        <div class="block-content block-content-full bg-primary-light" style="color: white; height: 400px; background-color: #98b9e3;text-align: center;">
                <br/>
                <i class="fa fa-newspaper-o fa-5x text-white" style="margin-top: 10px; font-size: 7em;"></i>
                <div class="text-white-op push-15-t welcome-text">
                        Chào mừng quý vị đến với hệ thống lưu điểm
                </div>
            </div>
            <!-- {if ($session.maQuyen==5)}
            <div class="block-content block-content-full bg-primary-light" style="color: white; height: 400px; background-color: #98b9e3;text-align: center;">
                <br/>
                <i class="fa fa-newspaper-o fa-5x text-white" style="margin-top: 10px; font-size: 7em;"></i>
                <div class="text-white-op push-15-t welcome-text">
                        Chào mừng quý vị đến với hệ thống thẩm định chức danh giáo sư, phó giáo sư
                </div>
            </div>
            {else}
                {foreach $myMenu as $k => $v}
                    {if !isset($v.chucNang)}
                        <div class="col-md-3">
                            <a href="{$url}{$v.sUrl}" title="{$v.sTenChucNang}">
                                <div class="feature">
                                    <div class="nameFeature">{$v.sTenChucNang}</div>
                                </div>
                            </a>
                        </div>
                    {/if}
                {/foreach}
            {/if} -->
        </div>
    </div>
</div>
<style type="text/css">
    .welcome-text{
        font-size: 40px;
        margin-top: 10px;
    }
    .feature{
        background-color: #ddd;
        width: 100%;
        height: 3cm;
        margin: 5px;
        padding: 25px;
        color: #fff;
        font-weight: bold;
        text-align: center;
        display: table;
    }
    .nameFeature{
        display: table-cell;
        vertical-align: middle;
    }
    @media screen and (max-width: 768px){
        .welcome-text{
            font-size: 30px;
            margin-top: 10px;
            padding-left: 15px;
            padding-right: 15px;
        }
    }
    @media screen and (max-width: 425px){
        .welcome-text{
            font-size: 25px;
            margin-top: 10px;
            padding-left: 10px;
            padding-right: 10px;
        }
    }
</style>
<script type="text/javascript">
    function getRandomColor() {
        var letters = '0123456789ABCDEF';
        var color = '#';
        for (var i = 0; i < 6; i++) {
            color += letters[Math.floor(Math.random() * 16)];
        }
        return color;
    }
    $(document).ready(function () {
        $('.feature').each(function (k, v){
            $(v).css("background-color", getRandomColor());
        });
    });
</script>
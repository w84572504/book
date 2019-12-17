<style type="text/css">
	.sm-st-icon {
    width: 60px;
    height: 60px;
    display: inline-block;
    line-height: 60px;
    text-align: center;
    font-size: 30px;
    background: #eee;
    -webkit-border-radius: 5px;
    -moz-border-radius: 5px;
    border-radius: 5px;
    float: left;
    margin-right: 10px;
    color: #fff;
}
.sm-st {
    background: #fff;
    padding: 20px;
    -webkit-border-radius: 3px;
    -moz-border-radius: 3px;
    border-radius: 3px;
    margin-bottom: 20px;
    -webkit-box-shadow: 0 1px 0px rgba(0, 0, 0, 0.05);
    box-shadow: 0 1px 0px rgba(0, 0, 0, 0.05);
}
</style>
<div class="col-sm-12 col-xs-12">
	<div class="sm-st clearfix">
	    <span class="sm-st-icon st-{{$color}}"><i class="fa fa-{{$icon}}"></i></span>
	    <div class="sm-st-info">
	        <span>{{$num}}</span>
	        {{$title}}</div>
	</div>
</div>
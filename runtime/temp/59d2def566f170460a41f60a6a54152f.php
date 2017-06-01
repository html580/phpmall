<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:63:"F:\code\php\ypwl-TwoThink-master\TwoThink\addons/digg\vote.html";i:1493988942;}*/ ?>
<link rel="stylesheet" type="text/css" href="__STATIC__/addons/digg/css/style.css">
<link rel="stylesheet" type="text/css" href="__STATIC__/addons/digg/css/font-awesome.min.css">
<script type="text/javascript">
	var vote_flag=false;
	var uid = <?php echo is_login(); ?>;
	function vote(id,type){
		if(<?php echo is_login(); ?> == 0){
			alert('请登录后再投票');
			return;
		}
		if(vote_flag == true){
			alert('<?php echo $addons_config['stop_repeat_tip']; ?>');
			return;
		}
		$.ajax({
			url: '<?php echo addons_url("Digg://Digg/vote"); ?>',
			data: {
				'id':id,
				'type':type
			},
			success:function(data){
				if(data.code){
					$('#vote_'+type).text(parseInt($('#vote_'+type).text())+1);
					update_vote();
				}else{
					alert(data.msg);
				}
				vote_flag = true;
			},
			error:function(XMLHttpRequest, textStatus, errorThrown){
				alert('发送请求失败了，请刷新后继续投票');
			}
		});
	}

	function update_vote(){
		var sUp = parseInt($('#vote_1').text());
		var sDown = parseInt($("#vote_2").text());
		var sTotal = sUp+sDown;
		if(sTotal == 0){
			var spUp = spDown = 50;
		}else{
			var spUp = (sUp/sTotal)*100;
			spUp = Math.round(spUp*10)/10;
			var spDown=100-spUp;
			spDown=Math.round(spDown*10)/10;
		}
		$('#sp1').text(spUp+'%');
		$('#sp2').text(spDown+'%');
		$('#eimg1').width(parseInt(spUp/100*70));
		$('#eimg2').width(parseInt(spDown/100*70));
	}

	$(function(){
		update_vote();
	})

</script>
<div id="vote_addon_box">
	<div class="pub_style up" onclick="vote(<?php echo $addons_vote_record['document_id']; ?>,1)">
		<div class="font_line">
			<i class="fa fa-thumbs-o-up fa-lg"></i><span><?php echo $addons_config['good_tip']; ?></span>
		</div>
		<div class="bar_line">
			<div class="prosess_bar">
				<div class="prosess_bar_content" id="eimg1"></div>
			</div>
			<span id="sp1">%</span>
			(<span id="vote_1"><?php echo (isset($addons_vote_record['good']) && ($addons_vote_record['good'] !== '')?$addons_vote_record['good']:0); ?></span>)
		</div>
		<b>顶</b>
	</div>
	<div class="pub_style down" onclick="vote(<?php echo $addons_vote_record['document_id']; ?>,2)">
		<div class="font_line">
			<i class="fa fa-thumbs-o-down fa-lg"></i><span><?php echo $addons_config['bad_tip']; ?></span>
		</div>
		<div class="bar_line">
			<div class="prosess_bar">
				<div class="prosess_bar_content" id="eimg2"></div>
			</div>
			<span id="sp2">%</span>
			(<span id="vote_2"><?php echo (isset($addons_vote_record['bad']) && ($addons_vote_record['bad'] !== '')?$addons_vote_record['bad']:0); ?></span>)
		</div>
		<b>踩</b>
	</div>
</div>
<div class="clearfix"></div>

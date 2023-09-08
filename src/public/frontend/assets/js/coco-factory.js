//lightbox 繧ｪ繝励す繝ｧ繝ｳ縺ｮ險ｭ螳壺ｻhttps://lokeshdhakar.com/projects/lightbox2/#options蜿ら�

lightbox.option({
    'wrapAround': true,//繧ｰ繝ｫ繝ｼ繝玲怙蠕後�蜀咏悄縺ｮ遏｢蜊ｰ繧偵け繝ｪ繝�け縺励◆繧峨げ繝ｫ繝ｼ繝玲怙蛻昴�蜀咏悄縺ｫ謌ｻ繧�
    'albumLabel': ' %1 / total %2 '//蜷郁ｨ域椢謨ｰ荳ｭ迴ｾ蝨ｨ菴墓椢逶ｮ縺九→縺�≧繧ｭ繝｣繝励す繝ｧ繝ｳ縺ｮ隕九○譁ｹ繧貞､画峩縺ｧ縺阪ｋ
  })
  
  //縺ｵ繧上▲縺ｨ隕九○繧九◆繧√�JS縲�3-5-3 繝壹�繧ｸ縺瑚ｪｭ縺ｿ霎ｼ縺ｾ繧後◆繧峨☆縺舌↓蜍輔°縺励◆縺�&逕ｻ髱｢繧偵せ繧ｯ繝ｭ繝ｼ繝ｫ繧偵＠縺溘ｉ蜍輔°縺励◆縺��ｴ蜷亥�縺ｮ繧ｽ繝ｼ繧ｹ繧ｳ繝ｼ繝我ｽｿ逕ｨ
  
  function fadeAnime(){
  // flipLeft
  $('.gallery li').each(function(){ 
      var elemPos = $(this).offset().top;
      var scroll = $(window).scrollTop();
      var windowHeight = $(window).height();
      if (scroll >= elemPos - windowHeight){
          $(this).addClass('flipLeft');
      }else{
          $(this).removeClass('flipLeft');
      }
  });
  }
  
  // 逕ｻ髱｢繧偵せ繧ｯ繝ｭ繝ｼ繝ｫ繧偵＠縺溘ｉ蜍輔°縺励◆縺��ｴ蜷医�險倩ｿｰ
      $(window).scroll(function (){
          fadeAnime();/* 繧｢繝九Γ繝ｼ繧ｷ繝ｧ繝ｳ逕ｨ縺ｮ髢｢謨ｰ繧貞他縺ｶ*/
      });// 縺薙％縺ｾ縺ｧ逕ｻ髱｢繧偵せ繧ｯ繝ｭ繝ｼ繝ｫ繧偵＠縺溘ｉ蜍輔°縺励◆縺��ｴ蜷医�險倩ｿｰ
  
  // 繝壹�繧ｸ縺瑚ｪｭ縺ｿ霎ｼ縺ｾ繧後◆繧峨☆縺舌↓蜍輔°縺励◆縺��ｴ蜷医�險倩ｿｰ
      $(window).on('load', function(){
          fadeAnime();/* 繧｢繝九Γ繝ｼ繧ｷ繝ｧ繝ｳ逕ｨ縺ｮ髢｢謨ｰ繧貞他縺ｶ*/
      });// 縺薙％縺ｾ縺ｧ繝壹�繧ｸ縺瑚ｪｭ縺ｿ霎ｼ縺ｾ繧後◆繧峨☆縺舌↓蜍輔°縺励◆縺��ｴ蜷医�險倩ｿｰ
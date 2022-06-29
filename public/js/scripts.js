$(document).ready(function(){

  $(document).on('click','.basego',function(){
      $.ajax({type:"POST",url:"/connectfilter2",
          data:{localhost:$(".localhost").val(),dbname:$(".dbname").val(),username:$(".username").val(),pas:$(".pas").val()},
          success: function(respa){
            if(respa !== ''){
              $(".sx").html(respa);
            }else{
              alert('Enter correct DB params first!');
            }
          }
      });
  });
 
  $(document).on('change',".clx2, .clx, .sx, .ss, .s3",function(){
    var tabll = $(".sx option:selected").text();
    if($(this).hasClass('clx')){
      var selll = $(".clx option:selected").text(),
          datt = {tabll:tabll,selll:selll};
          localStorage.setItem('clx',true);
      $('.onss2').css({"display":"block"});
      $('.onss2').append('<tr><td class="bel jj">'+$(this).find(":selected").text()+'</td></tr>');
    }else if($(this).hasClass('sx')){
      var tab = 'tab',
          datt = {tabll:tabll,tab:tab};
          localStorage.setItem('sx',true);
    }else if($(this).hasClass('ss')){
      $('.onss1').css({"display":"block"});
      $('.onss1').append('<tr><td class="del jj">'+$(this).find(":selected").text()+'</td></tr>');
    }
    if(localStorage.getItem('sx') !== null||localStorage.getItem('clx2') !== null||localStorage.getItem('clx') !== null){
        $.ajax({type:"POST",url:"connectfilter2.php",data:datt,success:function(resp){
          if(localStorage.getItem('clx2') !== null){
            $(".s3").css({"display":"block"});$("#s3").html(resp);  
          }else if(localStorage.getItem('clx') !== null){
            $("#ss").css({"display":"block"});$("#ss").html(resp);$(".pluscell").css({"display":"block"});
          }else if(localStorage.getItem('sx') !== null){
            $('.clx2').css({"display":"none"});$('.s3').css({"display":"none"});$('.clx').css({"display":"block"});$('.ccc').css({"display":"block"});$("#clx").html(resp);
          }
          localStorage.removeItem('clx2');localStorage.removeItem('clx');localStorage.removeItem('sx');
          }
        });
    }
  });

  $(document).on('click','.sel2, .ss',function(){
    var vals = [],cats = [];
    $('.del').each(function(){vals.push($(this).text());});
    $('.bel').each(function(){cats.push($(this).text());});
    var datt = {tabll:$('#tabll').val(),vals:vals,ca1:cats};
      $.ajax({type:"POST",url:"connectfilter2.php",data:datt,success: function(responce){
          $('#client').html(responce);
          $(".tabbl").html('<button type="button" class="mod-butt two">Create XLS file</button>');
        }
      });
  });
  
  $(document).on('click', '.mod-butt', function(){
    if($(this).attr('id') !== 'za'){
        var conn = '2';
        $.ajax({type:"POST",url:"connectfilter2.php",data:{dawadu:conn},success: function(once){
            $('.tabbl').append('<a style="margin:0 0 0 7px;" href="'+once+'.xls">Download</a>');
          }
        });
    }else{
      $('#myModal').show();
    }
  });

  $(document).on('click', '.del, .bel', function(){
    $(this).remove();
  });
});



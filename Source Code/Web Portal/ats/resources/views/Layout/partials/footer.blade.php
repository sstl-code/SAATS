
                    
    <!-- app-root @e -->
    <!-- select region modal -->
    
    <!-- JavaScript -->
    
    <script src="{{asset('assets/js/bundle.js?ver=3.1.0') }}"></script>
    <script src="{{asset('assets/js/editors.js?ver=3.1.0')}}"></script>
    <script src="{{asset('assets/js/scripts.js?ver=3.1.0')}}"></script>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.7/dist/umd/popper.min.js" integrity="sha384-zYPOMqeu1DAVkHiLqWBUTcbYfZ8osu1Nd6Z89ify25QV9guujx43ITvfi12/QExE" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.min.js" integrity="sha384-Y4oOpwW3duJdCWv5ly8SCFYWqFDsfob/3GkgExXKV4idmbt98QcxXYs9UoXAB7BZ" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.7/dist/umd/popper.min.js" integrity="sha384-zYPOMqeu1DAVkHiLqWBUTcbYfZ8osu1Nd6Z89ify25QV9guujx43ITvfi12/QExE" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.min.js" integrity="sha384-Y4oOpwW3duJdCWv5ly8SCFYWqFDsfob/3GkgExXKV4idmbt98QcxXYs9UoXAB7BZ" crossorigin="anonymous"></script></head>
   <script type="text/javascript" language="javascript" src="//code.jquery.com/jquery-1.11.1.min.js"></script>
   <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
   <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.js"></script>

   <script>
        $(window).on('load', function() { // makes sure the whole site is loaded 
			$('#preloader').hide(); // will first fade out the loading animation 
		})

    </script>
    <script>
    // Date Months
    const monthnumber = ["Jan","Feb","Mar","Apr","May","June","Jul","Aug","Sep","Oct","Nov","Dec"];
      $(document).ready(function() {
        $("input").keyup(function(){
          if($("input").parent().find("span").has("span")){            
            $("input").parent().find(".error").removeClass("error");
            $("input").parent().find("span").remove();
          }
        });
        $("select").change(function(){
          if($("select").parent().find("span").has("span")){            
            $("select").parent().find(".error").removeClass("error");
            $("select").parent().find("span").remove();
          }
        });
        
       $('.my-table').DataTable({
          paging: false,
        language: { search: '', searchPlaceholder: "Search Asset Type" },
        info: false,
      
        
        
      });
   });

   $(document).ready(function() {
    var table = $('#sitetable10').DataTable({
                paging: false,
                language: { search: '', searchPlaceholder: "Search Fixed Attribute" },
                info: false
            });

            $('.dataTables_wrapper .dataTables_filter input').on('input', function() {
                if ($(this).val().trim() === '') {
                    $(this).css('background-image', 'url("https://cdn3.iconfinder.com/data/icons/feather-5/24/search-512.png")');
                } else {
                    $(this).css('background-image', 'none');
                }
            });  
   });
   $(document).ready(function() {
       $('.my-table2').DataTable({
          paging: false,
        language: { search: '', searchPlaceholder: "Search Dynamic Attribute" },
        info: false,
        
      });
      $('.dataTables_wrapper .dataTables_filter input').on('input', function() {
                if ($(this).val().trim() === '') {
                    $(this).css('background-image', 'url("https://cdn3.iconfinder.com/data/icons/feather-5/24/search-512.png")');
                } else {
                    $(this).css('background-image', 'none');
                }
            }); 
   });
   $(document).ready(function() {
       $('.table_reason').DataTable({
          paging: false,
        language: { search: '', searchPlaceholder: "Reasons" },
        info: false,
        
      });
      $('#reasontable_filter input').addClass('reasonsearch');
      $('.dataTables_wrapper .dataTables_filter input').on('input', function() {
                if ($(this).val().trim() === '') {
                    $(this).css('background-image', 'url("https://cdn3.iconfinder.com/data/icons/feather-5/24/search-512.png")');
                } else {
                    $(this).css('background-image', 'none');
                }
            });
   });
  
   
   </script>
    <script>
      $(document).ready(function() {
       $('.config_table').DataTable({
        "oLanguage": { "Search": '<i class="icon-search"></i>' },        
        paging: false,
        language: { search: '<i class=""></i>', searchPlaceholder: "Search Site" },
        info: true
       });
       $('#sitetable5_filter input').addClass('sitesearch');
       $('.dataTables_wrapper .dataTables_filter input').on('input', function() {
                if ($(this).val().trim() === '') {
                    $(this).css('background-image', 'url("https://cdn3.iconfinder.com/data/icons/feather-5/24/search-512.png")');
                } else {
                    $(this).css('background-image', 'none');
                }
            });

       
      
   }); 
       $(document).ready(function() {
       $('.config_table_2').DataTable({
        "oLanguage": { "Search": '<i class="icon-search"></i>' },        
        paging: false,
        language: { search: '<i class=""></i>', searchPlaceholder: "Search Fixed Attribute" },
        info: true
       });
       $('#sitetable4_filter input').addClass('sitefixedsearch');
       $('.dataTables_wrapper .dataTables_filter input').on('input', function() {
                if ($(this).val().trim() === '') {
                    $(this).css('background-image', 'url("https://cdn3.iconfinder.com/data/icons/feather-5/24/search-512.png")');
                } else {
                    $(this).css('background-image', 'none');
                }
            });
       
       
       
   }); 
   $(document).ready(function() {
       $('.config_table1').DataTable({
        "oLanguage": { "Search": '<i class="icon-search"></i>' },        
        paging: false,
        language: { search: '<i class=""></i>', searchPlaceholder: "Search Site Type" },
        info: true,
        "ordering": false
       });
       $('#sitetable9_filter input').addClass('siteonly');
       $('.dataTables_wrapper .dataTables_filter input').on('input', function() {
                if ($(this).val().trim() === '') {
                    $(this).css('background-image', 'url("https://cdn3.iconfinder.com/data/icons/feather-5/24/search-512.png")');
                } else {
                    $(this).css('background-image', 'none');
                }
            });
       
       
   }); 
       $(document).ready(function() {
       $('.config_table_3').DataTable({
        "oLanguage": { "Search": '<i class="icon-search"></i>' },        
        paging: false,
        language: { search: '<i class=""></i>', searchPlaceholder: "Search Dynamic Attribute" },
        info: true
       });
       $('#sitetable3_filter input').addClass('sitedynamicsearch');
       $('.dataTables_wrapper .dataTables_filter input').on('input', function() {
                if ($(this).val().trim() === '') {
                    $(this).css('background-image', 'url("https://cdn3.iconfinder.com/data/icons/feather-5/24/search-512.png")');
                } else {
                    $(this).css('background-image', 'none');
                }
            });
       
   });
   $(document).ready(function() {
       $('.table_batch_asset').DataTable({
        "oLanguage": { "Search": '<i class="icon-search"></i>' },        
        paging: false,
        language: { search: '<i class=""></i>', searchPlaceholder: "Search...." },
        info: true
       });
       $('#batchtable_filter input').addClass('batchcssdatatable');
       $('.dataTables_wrapper .dataTables_filter input').on('input', function() {
                if ($(this).val().trim() === '') {
                    $(this).css('background-image', 'url("https://cdn3.iconfinder.com/data/icons/feather-5/24/search-512.png")');
                } else {
                    $(this).css('background-image', 'none');
                }
            });
   });
   $(document).ready(function() {
       $('.table_batch_technician').DataTable({
        "oLanguage": { "Search": '<i class="icon-search"></i>' },        
        paging: false,
        language: { search: '<i class=""></i>', searchPlaceholder: "Search...." },
        info: true
       });
       $('#batchtable_filter input').addClass('technicssdatatable');
       $('.dataTables_wrapper .dataTables_filter input').on('input', function() {
                if ($(this).val().trim() === '') {
                    $(this).css('background-image', 'url("https://cdn3.iconfinder.com/data/icons/feather-5/24/search-512.png")');
                } else {
                    $(this).css('background-image', 'none');
                }
            });
   });

   $(document).ready(function() {
       $('.my_table_batch').DataTable({
          paging: false,
          searching:false,
        //language: { search: '', searchPlaceholder: "Search" },
        info: false

      });
   });
   
   $(document).ready(function() {
       $('.system_log_table').DataTable({
          paging: true,
          lengthChange: false,
          searching:false,
          order: [[3, 'desc']],
        //language: { search: '', searchPlaceholder: "Search" },
        info: false

      });
   });
   $(document).ready(function() {
       $('#supertechtable').DataTable({
        "oLanguage": { "Search": '<i class="icon-search"></i>' },        
        paging: false,
        language: { search: '<i class=""></i>', searchPlaceholder: "Search" },
        info: true,
        "ordering": false
       });
       $('#sitetable9_filter input').addClass('siteonly');
       $('.dataTables_wrapper .dataTables_filter input').on('input', function() {
                if ($(this).val().trim() === '') {
                    $(this).css('background-image', 'url("https://cdn3.iconfinder.com/data/icons/feather-5/24/search-512.png")');
                } else {
                    $(this).css('background-image', 'none');
                }
            });
       
       
   }); 

   $(document).ready(function() {
       $('.stn_Task_Closure_table').DataTable({
          paging: false,
          searching:true,
          //fixedHeader: false,
          scrollX: true,
          scrollY: "400px",
          scrollCollapse: true,
        language: { search: '', searchPlaceholder: "Search" },
        info: false



      });

      toastr.options = {
  "closeButton": true,
  "debug": false,
  "newestOnTop": false,
  "progressBar": false,
  "positionClass": "toast-top-right",
  "preventDuplicates": false,
  "onclick": null,
  "showDuration": "300",
  "hideDuration": "1000",
  "timeOut": "5000",
  "extendedTimeOut": "1000",
  "showEasing": "swing",
  "hideEasing": "linear",
  "showMethod": "fadeIn",
  "hideMethod": "fadeOut"
}
   });

  function assetdetails(asset_id){
        
      
            $.ajax({
                type: "GET",       
                url: "{{url('SingAsstDetails')}}",
                data:{
                    'asst_id' : asset_id,
                    
                },
                
                success: function(result) {
                
                    if(result.status == 'success'){
                      $('#asset_history').empty();
                      $('#single_asset_table').empty();
                      var tagged_date="";
                      var tagged_by="";
                      var fixedattr="";
                      var dynamiattr="";
                      var image="";
                      var tag_number="";
                      var asset_tag_history="<table class='table table-striped' width='100%'><thead><tr><td style='text-align:left'>Tagged On</td><td scope='col'>Tag Number</td><td scope='col'>Tagged By</td></tr></thead><tbody>";
                      Object.entries(result.site_details).forEach(([key1, value1]) => {
                        $('#single_asset_table').append('<tr><td>Site Name</td><td>'+value1['tl_location_name']+'</td></tr><tr><td>Site Code</td><td>'+value1['tl_location_code']+'</td></tr>');
                      });
                        Object.entries(result.assetdetails).forEach(([key, value]) => {
                             
                             if(value['ta_asset_image']!=null){
                              image=value['ta_asset_image'];
                             }
                             else{
                              image="";
                             }
                             if(value['ta_asset_tag_number']!=null){
                              tag_number=value['ta_asset_tag_number'];
                             }
                             else{
                              tag_number="";
                             }
                            
                            $("#AssetHistoryModal").html(value['AssetTypeFull']+'-'+value['ta_asset_name']);
                            
                                $('#single_asset_table').append('<tr><td>Asset Type</td><td>'+value['AssetTypeFull']+'</td></tr><tr><td>Parent Asset Name</td><td>'+value['ParentAssetName']+'</td></tr><tr><td>Asset Name</td><td>'+value['ta_asset_name']+'</td></tr><tr><td>Serial Number</td><td>'+value['ta_asset_manufacture_serial_no']+'</td></tr><tr><td>Tag Number</td><td>'+tag_number+'</td></tr><tr><td>Asset Image</td><td><img style="width: 100px;" src="'+image+'"></td></tr>');
                            
                            if(value['ta_asset_catagory']=='Active'|| value['operators']!=null){
                              $('#single_asset_table').append('<tr><td>Operator Name</td><td>'+value['operators']+'</td></tr>');
                            }
                               
                             if(value['TypeAttr']){
                                Object.entries(value['TypeAttr']).forEach(([key1, value1]) => {
                                  if(value1['at_asset_attribute_value_text']=='' || value1['at_asset_attribute_value_text']==null)
                                  {
                                    value1['at_asset_attribute_value_text']="";
                                  }
                                 
                                  if(value1['AttrCatagory']==0){
                                  
                                    fixedattr=fixedattr+'<tr><td>'+value1['at_asset_attribute_name']+'</td><td>'+value1['at_asset_attribute_value_text']+'</td></tr>';
                                
                                  }
                                  if(value1['AttrCatagory']==1){
                                  
                                 
                                    dynamiattr=dynamiattr+'<tr><td>'+value1['at_asset_attribute_name']+'</td><td>'+value1['at_asset_attribute_value_text']+'</td></tr>';
                                
                                  }
                                });
                              }
                               
                                

                     
                        });
                        
                         
                        console.log(result.Tag_history);
                        
                        Object.entries(result.Tag_history).forEach(([key2, value2]) => {
                          //var tag_history=JSON.parse(value2.asset_data);
                          
                     console.log(value2['th_asset_tag_number']);
                      if(value2['th_asset_tag_number']!=null){
                     
                     
                              if(value2['UserName']!=null){
                                var tagged_by=value2['UserName'];
                              }else{
                                var tagged_by="";
                              }
                          
                          //var tagged_date=new Date(tag_history.Creation_Date);
                          let position=asset_tag_history.search(value2['th_asset_tag_number']);
                        
                          if(position==-1){
                          asset_tag_history=asset_tag_history+'<tr><td style="text-align:left">'+value2['created_at']+'</td><td>'+value2['th_asset_tag_number']+'</td><td>'+tagged_by+'</td></tr>';
                          }
                                         }
                      });

                        if(fixedattr!=""){
                          fixedattr="<tr><td colspan='2' align='center' class='attrasstdetails'>Fixed Attribute</td></tr>"+fixedattr;
                        }
                        if(dynamiattr!="")
                        {
                          dynamiattr="<tr><td colspan='2' align='center' class='attrasstdetails'>Dynamic Attribute</td></tr>"+dynamiattr;
                        }
                        if(asset_tag_history!="")
                        {   
                        asset_tag_history="<tr><td colspan='2'  class='attrasstdetails'>Tag History</td></tr><tr><td colspan='2' style='padding: 0 ! important'>"+asset_tag_history+'</td></tr>';
                        }
                        $('#single_asset_table').append(fixedattr+dynamiattr+asset_tag_history);
                         $('#assetdetailsmodal').modal('toggle');
                     
                           
                            
                           
                          
                   
                    }
                  
                    
                  }

           })
        }
   



   </script>

  {{-- Modal Asset Details --}}
  <div class="modal fade" id="assetdetailsmodal" tabindex="-1" role="dialog" aria-labelledby="AssetHistoryModal" aria-hidden="true">
    <div class="modal-dialog" role="document" style="width: 50%;">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="AssetHistoryModal"></h5>
          <button type="button" class="close" data-bs-dismiss="modal" aria-label="close">
            &times;
          </button>
        </div>
        <div class="modal-body">
          <table id="tablet" class="table table-bordered" style="font-size: smaller;">
            <tbody id="single_asset_table">
              </tbody>
         </table>
        </div>
        <div class="modal-footer">
          
          <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Close</button>
          
        </div>
      </div>
    </div>
  </div>


 
  
@if (Auth::user())
 <form id="loginFrmToken" name="loginFrmToken" method="POST" target="top">
     @csrf
     <input type="hidden" name="token" value="{{ base64_encode(Auth::user()->id) }}">
     <input type="submit" value="submit" style="display:none;">
  </form>
  <script>
   
     
  
    function loginusingToken()
    {
      
     document.getElementById('loginFrmToken').action="{{ $common_data['User_Managment'] }}";
     document.getElementById('loginFrmToken').method="POST";
      document.getElementById('loginFrmToken').submit();
    }
    
  </script>
@endif

<script>
 $(function() {
      setInterval(function checkSession() {
        $.get('{{ url("check-session") }}', function(data) {
          if (data.guest) {
            location.reload();
          }
        });
      }, 60000); // every minute
    });
</script>
</body>
</html>
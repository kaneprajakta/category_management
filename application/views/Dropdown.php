<!DOCTYPE html>
<html>
<head>
    <title>CodeIgniter: Dependent dropdown list by using single table value</title>
    <!-- load bootstrap css -->
    <link rel="stylesheet" type="text/css" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <!-- load jquery library -->
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <!-- load bootstrap js -->
    <script type="text/javascript" src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>
    <div class="container">
        <div class="form-group" id="filter" name="filter">
            <br>
            <div id="1" name="1" class="dd">
            <select class="form-control"  id="category1" name="category1">
                <option value="0" selected="selected">--Select Category level <?= $level?>--</option>
                <?php if (isset($data)):?>
                    <?php foreach ($data as $key => $value): ?>
                        <option value="<?=$value['cat_id']?>"><?=$value['cat_name']?></option>
                    <?php endforeach ?>
                <?php endif ?>
            </select>
            </div>
            
        </div>
    
    <script type="text/javascript">
        $(document).ready(function(){
            
            $(document).on('change',"select",function () {
               
                var objects = $(".dd");
                for (var objDiv of objects) {
                    var a = parseInt(objDiv.id);
                    var b = parseInt((this.id).charAt((this.id).length - 1));
                    
                    if(a > b){ 
                        //alert('a:'+a+'b:'+b);
                        $('#'+objDiv.id).remove();
                    }
                }
                // get selected client name
                var category = $(this).find('option:selected').val();
                var lvl      = $(this).parent.id;
                
                // post data with CSRF token
                var data = {
                    action:'subcat',
                    cat_id: category,
                    l:lvl
                };

                // AjaxPOST to get projects
                $.post('./', data, function(json) {
                    console.log(json);
                    if(json.dd != false){
                        if(json.dd == "no_subcat"){
                            $('#msgDiv').html("<p>No further categories</p>");
                           
                        }else{
                        $('#msgDiv').html("");
                        
                        var subcat_data = '<br><div class="dd" id="'+json.level+'" name="'+json.level+'"><select class="form-control" class="cat" id="category'+json.level+'" name="category'+json.level+'"><option value="0" selected="selected">--Select Category Level '+json.level+'--</option>';
                        
                        $.each(json.dd, function(index, obj){
                            subcat_data += '<option value="'+obj.cat_id+'">'+obj.cat_name+'</option>';
                        });
                        subcat_data += "</select></div>";
                        // append all projects in project dropdown
                        $('#filter').append(subcat_data);
                        }
                    }else{
                        $('#msgDiv').html("<p>Please select option</p>");
                        
                    }
                }, 'JSON');
            });
            
        });
    </script>
    <div id="msgDiv" name="msgDiv"></div>
    </div>
</body>
</html>

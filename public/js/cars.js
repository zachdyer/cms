var inventory = {
    ref: null,
    add: function () {
        var make = $("#make").val();
        var model = $("#select-model").val();
        var year = $("#yearpicker").val();
        var price = $("#price").val();
        var desc = $("#description").val();
        
        if(make === "" || model === "") {
            return false;
        } else {
            var database = firebase.database();
            inventory.ref = database.ref("inventory");
            var data = {
                "make": make,
                "model": model,
                "year": year,
                "price": price,
                "desc": desc
            };
            inventory.ref.push(data);
            return false;
        }
    },
    init: function () {
        window.addEventListener("load", function () {
            $.ajax({
                type: "get",
                url: "/json/models.json",
                success: function(data) {
                  inventory.models = data;

                  //enabled model selector
                  $("#model").attr("disabled", false);

                  //Create Make selector
                  for(var i = 0; i < data.length; i++) {
                      var option = $("<option value='"+data[i].title+"' data-index='"+i+"'>"+data[i].title+"</option>");
                      $("#make").append(option);
                  }

                  //If make id set then select option
                  var make_id = $("#make_id").val();
                  if(make_id) {

                    $("#make option[data-index = " + make_id + "]").attr('selected','selected');

                    //Create model selector menu
                    for(let i = 0; i < inventory.models[make_id].models.length; i++ ) {
                      var model = inventory.models[make_id].models[i];
                      var modelOption = $("<option value='"+model.title+"' data-index='"+i+"'>"+model.title+"</option>");
                      $("#model").append(modelOption);
                    }

                    //If model id set then select option
                    var modelid = $("#modelid").val();
                    if(modelid) {
                       $("#model option[data-index = " + modelid + "]").attr('selected','selected');
                    }

                  }

                  //Create year selector
                  for (i = new Date().getFullYear(); i > 1900; i--) {
                      $('#year').append($('<option />').val(i).html(i));
                  }
                  
                  //If year is set select year option
                  var year = $("#year").val();
                  if(year) {
                    $("#year option[value = " + year + "]").attr('selected','selected');
                  }
                  
                  var color = $("#color").val();
                  if(color) {
                    selectOption("color", color);
                  }
                  
                },
                dataType: "json"
            });
        })
        
    },
    models: null,
    update: {
        make: function () {
            var make_id = parseInt($("#make option:selected").attr("data-index"));
            $("#make_id").val(make_id);
            
            //Create model selector menu
            $("#model").html("");
            for(var i = 0; i < inventory.models[make_id].models.length; i++ ) {
                var model = inventory.models[make_id].models[i];
                var option = $("<option value='"+model.title+"' data-index='"+i+"'>"+model.title+"</option>");
                $("#model").append(option);
            }
            
        },
        model: function() {
          var modelid = parseInt($("#model option:selected").attr("data-index"));
          $("#modelid").val(modelid);
        }
    },
    select: {
        make: function(make){
            $("#make option").each(function(index){
                if($( this ).text() == make) {
                    $(this).prop("selected", true);
                }
            });
        }
    }
}

inventory.init();
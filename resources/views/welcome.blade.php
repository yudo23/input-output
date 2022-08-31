<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{URL::to('/')}}/assets/bootstrap/bootstrap.css">

    <!-- Sweetaler -->
    <link rel="stylesheet" href="{{URL::to('/')}}/assets/sweetalert2/sweetalert2.min.css">
    
    <title>Input Ouput</title>
  </head>
  <body>
    <div class="container mt-5">
        <div class="row mb-3">
            <div class="col-12">
                <div class="card ">
                    <div class="card-body">
                        <h6>Soal #1</h6>
                        <form id="frmSoal1" method="get" action="#">
                            <div class="form-group row">
                                <div class="col-lg-3 mb-2">
                                    <label>Input One Line Of Words (S)</label>
                                </div>
                                <div class="col-lg-9 mb-2">
                                    <input type="text" class="form-control soal-1-input"/>
                                </div>
                            </div>
                            <button disabled type="submit" class="btn btn-primary">Show Output</button>
                        </form>
                        <div class="row mt-2">
                            <div class="col-12 soal-1-alert">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-12">
                <div class="card ">
                    <div class="card-body">
                        <h6>Soal #2</h6>
                        <form id="frmSoal2" method="get" action="#">
                            <div class="form-group row">
                                <div class="col-lg-3 mb-2">
                                    <label>Input The number Of Families</label>
                                </div>
                                <div class="col-lg-9 mb-2">
                                    <input type="text" class="form-control soal-2-input-1 number-format"/>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-lg-3 mb-2">
                                    <label>Input The number Of Members In Family</label>
                                </div>
                                <div class="col-lg-9 mb-2">
                                    <input type="text" class="form-control soal-2-input-2"/>
                                </div>
                            </div>
                            <button disabled type="submit" class="btn btn-primary">Show Output</button>
                        </form>
                        <div class="row mt-2">
                            <div class="col-12 soal-2-alert">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Main jQuery -->
    <script src="{{URL::to('/')}}/assets/jquery/jquery.js"></script>
    <!-- Bootstrap 5:0 -->
    <script src="{{URL::to('/')}}/assets/bootstrap/popper.min.js"></script>
    <!-- Sweetalert -->
    <script src="{{URL::to('/')}}/assets/sweetalert2/sweetalert2.min.js"></script>
    <script>
        $(function(){
            $('button[type="submit"]').attr("disabled",false);

            $(document).on("keypress keyup blur",".number-format",function(e){
                $(this).val($(this).val().replace(/[^\d].+/, ""));
                if ((e.which < 48 || e.which > 57)) {
                    e.preventDefault();
                }
            });

            $(document).on("submit","#frmSoal1",function(e){
                e.preventDefault();
                let value = $(".soal-1-input").val().trim();
                let vokal_valid = ['a','i','u','e','o'];
                let konsonan_valid = ['b', 'c', 'd', 'f', 'g', 'h', 'j', 'k', 'l', 'm', 'n', 'p', 'q', 'r', 's', 't', 'v', 'w', 'y', 'z'];
                let isError = false;

                if(value == "" || value == undefined || value == null){
                    $(".soal-1-alert").html("");
                    swal_error("ERROR #Question 1 . No words to display");
                    isError = true;
                    return false;
                }
                else{
                    let split_value = value.split("");
                    let output = "";
                    let output_vokal = "";
                    let output_konsonan = "";

                    split_value.forEach((element,index) => {
                        if(element != "" || element != null || element != undefined){
                            if(vokal_valid.includes(element.toLowerCase())){
                                output_vokal += (element.toLowerCase()+"");
                            }
                            else if(konsonan_valid.includes(element.toLowerCase())){
                                output_konsonan += (element.toLowerCase()+"");
                            }
                        }
                    });
                    
                    if(output_vokal != "" || output_konsonan != ""){
                        output = `
                            <div class="alert alert-primary" role="alert">
                                <h6><b>Input : ${value}</b></h6>
                                <h6><b>Output : </b></h6>
                                <p style="margin-top:0;margin-bottom:0;padding-top:0;padding-bottom:0;">Vowel Characters</p>
                                <p style="margin-left:20px;"><b>${output_vokal}</b></p>
                                <p style="margin-top:0;margin-bottom:0;padding-top:0;padding-bottom:0;">Consonants Characters</p>
                                <p style="margin-left:20px;"><b>${output_konsonan}</b></p>
                            </div>
                        `;
                    }
                    else{
                        swal_error("ERROR #Question 1 . No vowel / consonant characters found");
                    }

                    $(".soal-1-alert").html(output);
                    
                }

            })

            $(document).on("submit","#frmSoal2",function(e){
                e.preventDefault();
                let value_1 = $(".soal-2-input-1").val().trim();
                let value_2 = $(".soal-2-input-2").val().trim();
                let max_bus_passenger = 4;
                let isError = false;

                if(value_1 == null || value_1 == undefined || value_1 == "" || value_2 == null || value_2 == undefined || value_2 == ""){
                    $(".soal-2-alert").html("");
                    swal_error("ERROR #Question 2 . Number of families or number of members in family is required");
                    isError = true;
                    return false;
                }

                if(isNaN(value_1) == true){
                    $(".soal-2-alert").html("");
                    swal_error("ERROR #Question 2 . Number of families must be numeric");
                    isError = true;
                    return false;
                }

                if(parseInt(value_1) <= 0){
                    $(".soal-2-alert").html("");
                    swal_error("ERROR #Question 2 . Number of families must be more than 0");
                    isError = true;
                    return false;
                }

                let split_value_2 = value_2.split(" ");
                let total_passenger = 0;
                let total_equal = 0;
                let total_bus_required = 0;

                if(split_value_2.length <= 0){
                    $(".soal-2-alert").html("");
                    swal_error("ERROR #Question 2 . Number of member in value is invalid");
                    isError = true;
                    return false;
                }

                split_value_2.forEach((element,index) => {
                    if(isNaN(element) == false){
                        if(element == 0){
                            $(".soal-2-alert").html("");
                            swal_error("ERROR #Question 2 . Input first char / after space cannot 0");
                            isError = true;
                            return false;
                        }

                        total_passenger += parseInt(element);
                        total_equal += 1;
                    }
                    else{
                        
                        $(".soal-2-alert").html("");
                        swal_error("ERROR #Question 2 . Input after space must be numeric");
                        isError = true;
                        return false;
                    }
                });

                if(total_equal != parseInt(value_1)){
                    $(".soal-2-alert").html("");
                    swal_error("ERROR #Question 2 . Input must be equal with count of family");
                    isError = true;
                    return false;
                }

                if(isError == false){

                    if(total_passenger > max_bus_passenger){
                        if(total_passenger%max_bus_passenger == 0){
                            total_bus_required = total_passenger/max_bus_passenger;
                        }
                        else{
                            total_bus_required = Math.ceil(total_passenger/max_bus_passenger);
                        }
                    }
                    else{
                        total_bus_required = 1;
                    }

                    let output = `
                        <div class="alert alert-primary" role="alert">
                            <h6><b>Input The Number Of Families : ${value_1}</b></h6>
                            <h6><b>Input The Number Of Members In Family : ${value_2}</b></h6>
                            <h6><b>Output : </b></h6>
                            <p style="margin-top:0;margin-bottom:0;padding-top:0;padding-bottom:0;margin-left:20px;">Minimum bus required is ${total_bus_required}</p>
                        </div>
                    `;

                    $(".soal-2-alert").html(output);
                }
            })
        })

        function swal_error(message) {
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: message,
                width: 400,
                height : 100,
                timer : 10000
            })
        }
    </script>
  </body>
</html>
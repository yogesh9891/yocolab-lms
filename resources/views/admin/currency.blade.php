@extends('layouts.backend')
@section('content')
<div class="our-dashbord dashbord">
		<div class="dashboard_main_content">
			<div class="container-fluid">
				<div class="main_content_container">
					<div class="row">
					  @if (Session::has('flash_message'))
                        <div class="container">
                            <div class="alert alert-success">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                {{ Session::get('flash_message') }}
                            </div>
                        </div>
                    @endif
						<div class="col-lg-12">

							<nav class="breadcrumb_widgets" aria-label="breadcrumb mb30">
								<h4 class="title float-left">Currency</h4>  
						
							</nav>
						</div>
					
                            <table class="table table-bordered table-striped table-vcenter js-dataTable-full">
                                <thead>
                                    <tr>
                                        <th class="text-center">USD</th>
                                        <td id="USD"></td>
                                    </tr>
                                    <tr>
                                        <th class="text-center">INR</th>
                                        <td id="INR"></td>
                                    </tr>
                                    <tr>
                                        <th class="text-center">EUR</th>
                                        <td id="EUR"></td>
                                    </tr>
                                    <tr>
                                        <th class="text-center">GBP</th>
                                        <td id="GBP"></td>
                                    </tr>
                                    <tr>
                                        <th class="text-center">SGD</th>
                                        <td id="SGD"></td>
                                    </tr>
                                </thead>
                                <tbody>
                         
                                    <tr>
                                 
                                    </tr>
                              
                                </tbody>
                            </table>
                         
						  
				
					</div>
					
				</div>
			</div>
		</div>
	</div>

	@endsection

    @section('afterScript')
    <script type="text/javascript">
        $(document).ready(function () {
       let access_key = '0858d40603b3f33ba08af4652413ed0f'; 
       let base = 'EUR';  
       let symbols = ['USD','INR','EUR','GBP','SGD'];

       fetchCurrency(); 

            function fetchCurrency() {
                endpoint = 'latest'


                    // get the most recent exchange rates via the "latest" endpoint:
                    $.ajax({
                        url: 'https://data.fixer.io/api/' + endpoint + '?access_key=' + access_key +'&base=' + base+ '&symbols='+ symbols ,
                        dataType: 'jsonp',
                        success: function(json) {
console.log(json);
                  
                       let rates = json.rates;
                     $('#USD').text(rates.USD);
                     $('#INR').text(rates.INR);
                     $('#EUR').text(rates.EUR);
                     $('#GBP').text(rates.USD);
                     $('#SGD').text(rates.SGD);
                       
                            
                        }
                    });
            }
        })
    </script>
    @endsection
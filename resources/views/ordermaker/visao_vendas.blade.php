@extends('layouts.app')

@section('title', 'Order Maker - Grupo Produto')

@section('style')

@endsection

@section('content')
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-sm-4">
        <table class="table">
        <td><img src="/img/asset_upload_file89_38151.png"></td>
        <td><div class="text-center"><h2>Elanco Brasil</h2></div></td>
        </table>
        <ol class="breadcrumb">
            <li><a href="/">&nbsp;&nbsp;&nbsp;&nbsp;Início</a></li>
        <li class="active"><strong>Lista</strong></li>
        </ol>
    </div>
</div>
<div class="wrapper wrapper-content">
	<div class="row">
	    <div class="col-lg-12">
			<div class="ibox">
				<div class="ibox-title">
                	<h2>Cliente</h2>
            	</div>
            	<div class="ibox-content">
            		<div class="row">
            			<div class="col-md-4">
            				<div class="form-gruop" id="data1">
            					<div class="input-group date">
                                    <span class="input-group-addon"><i class="fa fa-calendar"></i></span><input type="date" class="form-control">
                                </div>
                            </div>
        				</div>
			            	<div class="col-md-4">
								<div class="form-gruop" id="data1">
									<div class="input-group date">
	                        			<span class="input-group-addon"><i class="fa fa-calendar"></i></span><input type="date" class="form-control">
	                    			</div>
	                			</div>
							</div>
            			<div class="col-md-offset-11">
							<button type="button" class="btn btn-primary btn-circle"><i class="fa fa-refresh"></i></button>
            			</div>
            		</div>
            	</div>
        	</div>
        </div>
    </div>
	<div class="row">
        <div class="col-lg-6">
            <div class="ibox">
                <div class="ibox-content">
                    <h1></h1>
                    <div class="text-left">
                        <h5>Key Account</h5>
                        <div id="sparkline1">
                        <canvas style="display: inline-block; width: 140px; height: 140px; vertical-align: top;" width="140" height="140"></canvas>
                        </div>
                        <br>
                        <div class="table-responsive">
                            <table id="table1" class="table table-bordered table-hover"  cellspacing="0" width="100%" style="...">
                                <thead>
                                    <tr>
                                        <th>Cliente</th>
                                        <th>Espede</th>
                                        <th>Valor</th>
                                    </tr>
                                </thead>
                                    <tr> 
                                        <td>BRFoods</td>
                                        <td>Bovinos</td>
                                        <td>RS 15.500</td>
                                    </tr>
                                    <tr> 
                                        <td>Ceara</td>
                                        <td>Aves e Suinos</td>
                                        <td>RS 5.500</td>
                                    </tr>
                                    <tr> 
                                        <td>BRFoods</td>
                                        <td>Aimais de Ca</td>
                                        <td>RS 5.500</td>
                                    </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="ibox">
                <div class="ibox-content">
                    <h1></h1>
                    <div class="text-left">
                        <h5>Others</h5>
                        <div id="sparkline2">
                        <canvas style="display: inline-block; width: 140px; height: 140px; vertical-align: top;" width="140" height="140"></canvas>
                        </div>
                        <br>
                        <div class="table-responsive">
                            <table id="table2" class="table table-bordered table-hover"  cellspacing="0" width="100%" style="...">
                                <thead>
                                    <tr>
                                        <th>Cliente</th>
                                        <th>Espede</th>
                                        <th>Valor</th>
                                    </tr>
                                </thead>
                                    <tr> 
                                        <td>BRFoods</td>
                                        <td>Bovinos</td>
                                        <td>RS 15.500</td>
                                    </tr>
                                    <tr> 
                                        <td>Ceara</td>
                                        <td>Aves e Suinos</td>
                                        <td>RS 5.500</td>
                                    </tr>
                                    <tr> 
                                        <td>BRFoods</td>
                                        <td>Aimais de Ca</td>
                                        <td>RS 5.500</td>
                                    </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
<!-- Sparkline -->
<script src="/js/plugins/sparkline/jquery.sparkline.min.js"></script>
    <script>
        $(document).ready(function() {
            var sparklineCharts = function(){
                 $("#sparkline1").sparkline([70, 20, 10], {
                     type: 'pie',
                     height: '200',
                     sliceColors: ['#1ab394', '#F5F5F5', '#000000']
                 });

                $("#sparkline2").sparkline([30, 70], {
                     type: 'pie',
                     height: '200',
                     sliceColors: ['#1ab394', '#F5F5F5']
                 });
            };

            var sparkResize;

            $(window).resize(function(e) {
                clearTimeout(sparkResize);
                sparkResize = setTimeout(sparklineCharts, 500);
            });

            sparklineCharts();
        });
    </script>



@endsection

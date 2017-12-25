@extends('layouts.app')
@section('content')
<div class="content-wrapper">
    <div class="container-fluid">
        <div class="col-md-12 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading"> 
                </div>
                <div class="container">
    <div class="row">
        <div class="well col-xs-10 col-sm-10 col-md-6 col-xs-offset-1 col-sm-offset-1 col-md-offset-3">
            <div class="row">
                <div class="col-xs-6 col-sm-6 col-md-6">
                    <address>
                        <strong>AllyTees.com</strong>
                        <br>
                        P.O. Box 2012
                        <br>
                        Detroit, Mi 48000
                        <br>
                        <abbr title="Phone">P:</abbr> (213) 484-6829
                    </address>
                </div>
                <div class="col-xs-6 col-sm-6 col-md-6 text-right">
                    <p>
                        <em>Date: November, 12 2013</em>
                    </p>
                    <p>
                        <em>Receipt #: 0000015</em>
                    </p>
                </div>
            </div>
            <div class="row">
                <div class="text-center"> 
                    <h1>Receipt</h1>
                </div>
                </span>
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Product</th>
                            <th>#</th>
                            <th class="text-center">Price</th>
                            <th class="text-center">Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="col-md-9"><em>my best-friend is transgender</em></h4></td>
                            <td class="col-md-1" style="text-align: center"> 2 </td>
                            <td class="col-md-1 text-center">$28</td>
                            <td class="col-md-1 text-center">$56</td>
                        </tr>
                        <tr>
                            <td class="col-md-9"><em>my best-friend is transgender</em></h4></td>
                            <td class="col-md-1" style="text-align: center"> 1 </td>
                            <td class="col-md-1 text-center">$28</td>
                            <td class="col-md-1 text-center">$28</td>
                        </tr>
                        <tr>
                            <td>   </td>
                            <td>   </td>
                            <td class="text-right">
                            <p>
                                <strong>Subtotal: </strong>
                            </p>
                            <p>
                                <strong>Tax: </strong>
                            </p></td>
                            <td class="text-center">
                            <p>
                                <strong>$6.94</strong>
                            </p>
                            <p>
                                <strong>$6.94</strong>
                            </p></td>
                        </tr>
                        <tr>
                            <td>   </td>
                            <td>   </td>
                            <td class="text-right"><h4><strong>Total: </strong></h4></td>
                            <td class="text-center text-danger"><h4><strong>$31.53</strong></h4></td>
                        </tr>
                    </tbody>
                </table>
                <div>
                    <h1 style="text-align:center;">
                        Thank you for your order.
                    </h1>
                    
                </div>
            </div>
        </div>
    </div>
                <div class="clearfix">&nbsp;</div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('js')
<script type="text/javascript">
 
</script>
@endpush

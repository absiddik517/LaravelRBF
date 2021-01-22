@extends('layouts.master')

@section('title')
<title>Add Loan</title>
@endsection


@section('body')
<section class="content-header">
    <h1>
        Outcash
        <small>Add Outcash</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="/"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active"><a href="/outcash">Outcash</a></li>
    </ol>
</section>

<!-- Main content -->
<section class="content">

    <!-- /.row -->
    <!-- Main row -->
    <div class="row">
        <!-- Left col -->
        <section class="col-lg-7 connectedSortable">
            <!-- Custom tabs (Charts with tabs)-->
            <div class="box box-solid ">
                <div class="overlay" id="from_loader">
                    <img src="images/spinner.gif">
                </div>
                <div class="box-header">
                    <i class="fa fa-th"></i>

                    <h3 class="box-title">Add Loan</h3>

                    <div class="box-tools pull-right">
                        <button type="button" class="btn bg-teal btn-sm" data-widget="collapse"><i class="fa fa-minus"></i>
                        </button>
                        <button type="button" class="btn bg-teal btn-sm" data-widget="remove"><i class="fa fa-times"></i>
                        </button>
                    </div>
                </div>



                <div class="box-body border-radius-none">
                    <form class="form-horizontal" id="addLoanForm">
                        <div class="overlay"><img src="{{ asset('images/system/spinner.gif') }}" alt=""></div>
                        <div class="is_owner_group form-group">
                            <label for="type" class="col-sm-3 control-label">Loan Type</label>

                            <div class="col-sm-9">
                                <select class="is_owner form-control">
                                    <option value="Yes">From Owner</option>
                                    <option value="No">Normal Loan</option>
                                </select>
                                <span class="invalid-feedback"></span>
                            </div>
                        </div>

                        <div class="name_group form-group">
                            <label for="name" class="col-sm-3 control-label">Name</label>

                            <div class="col-sm-9">
                                <input type="text" class="name form-control" autocomplete="off">
                                <span class="invalid-feedback"></span>
                            </div>
                        </div>
                        
                        <div class="name_group owner_name_group form-group">
                            <label for="name" class="col-sm-3 control-label">Name</label>

                            <div class="col-sm-9">
                                <select class="owner_name form-control">
                                    @foreach(App\Model\Company::where('init', 'Owner_Id')->get() as $key)
                                    @php 
                                        $data = App\Model\Owner::where('id', $key['config'])->first();
                                    @endphp
                                    <option value="{{ $data['name_en'] }}">{{ $data['name_en'] }}</option>
                                    @endforeach
                                </select>
                                <span class="invalid-feedback"></span>
                            </div>
                        </div>
                        
                        

                        <div class="address_group form-group">
                            <label for="address" class="col-sm-3 control-label">Address</label>

                            <div class="col-sm-9">
                                <input type="text" class="address form-control" autocomplete="off">
                                <span class="invalid-feedback"></span>
                            </div>
                        </div>
                        
                        <div class="phone_group form-group">
                            <label for="phone" class="col-sm-3 control-label">Phone</label>

                            <div class="col-sm-9">
                                <input type="text" class="phone form-control" autocomplete="off" data-intype="number">
                                <span class="invalid-feedback"></span>
                            </div>
                        </div>

                        <div class="description_group form-group">
                            <label for="description" class="col-sm-3 control-label">Description</label>

                            <div class="col-sm-9">
                                <input type="text" class="description form-control" autocomplete="off">
                                <span class="invalid-feedback"></span>
                            </div>
                        </div>

                        <div class="amount_group form-group">
                            <label for="amount" class="col-sm-3 control-label">Amount</label>

                            <div class="col-sm-9">
                                <input type="text" data-intype="number" class="amount form-control" autocomplete="off">
                                <span class="invalid-feedback"></span>
                            </div>
                        </div>


                    </div>
                    <!-- /.box-body -->
                    <div class="box-footer">
                        <button type="submit" id="addLoan" class="btn btn-info pull-right">Submit</button>
                    </div>
                </form>
                <!-- /.box-footer -->

            </div>
            
            <pre id="console"></pre>

        </section>
        <!-- /.Left col -->
        <!-- right col (We are only adding the ID to make the widgets sortable)-->
        <section class="col-lg-5 connectedSortable">


            <!-- solid sales graph -->
            <div class="box box-solid">
                <div class="overlay" id="history_loader">
                    <img src="images/spinner.gif" alt="">
                </div>
                <div class="box-header">
                    <i class="fa fa-th"></i>

                    <h3 class="box-title">Last Outcash History</h3>

                    <div class="box-tools pull-right">
                        <button type="button" class="btn bg-teal btn-sm" data-widget="collapse"><i class="fa fa-minus"></i>
                        </button>
                        <button type="button" class="btn bg-teal btn-sm" data-widget="remove"><i class="fa fa-times"></i>
                        </button>
                    </div>
                </div>

                <div class="box-body border-radius-none">
                    <form class="form-horizontal">

                        <div class="form-group">
                            <label for="ldate" class="col-sm-4 control-label">Date</label>

                            <div class="col-sm-8">
                                <input disabled type="text" class="form-control" id="ldate">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="lname" class="col-sm-4 control-label">Name</label>

                            <div class="col-sm-8">
                                <input disabled type="text" class="form-control" id="lname">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="laddress" class="col-sm-4 control-label">Address</label>

                            <div class="col-sm-8">
                                <input disabled type="text" class="form-control" id="laddress">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="ldescription" class="col-sm-4 control-label">Description</label>
                            <div class="col-sm-8">
                                <input disabled type="text" class="form-control" id="ldescription">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="lamount" class="col-sm-4 control-label">Amount</label>
                            <div class="col-sm-8">
                                <input disabled type="text" class="form-control" id="lamount">
                            </div>
                        </div>

                    </form>
                </div>

            </div>
        </section>
        <!-- right col -->
    </div>
    <!-- /.row (main row) -->
</section>
@endsection


@section('script')
<script>
    $(document).ready(function() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-Token': '{{ csrf_token() }}'
            }
        });


        $('#addLoanForm').submit(function(e) {
            e.preventDefault();
            StoreNewLoan();
        });
        
        $('#addLoanForm select.is_owner').change(function(){
            removeValidation();
            init_form();
        });


        function StoreNewLoan() {
            let form = "#addLoanForm";
            let _data = {
                is_owner: $(form + ' select.is_owner').val(),
                name: undefined,
                address: $(form + ' input.address').val(),
                phone: $(form + ' input.phone').val(),
                description: $(form + ' input.description').val(),
                amount: $(form + ' input.amount').val()
            };
            
            if(_data.is_owner == 'Yes'){
                _data.name = $(form + ' select.owner_name').val();
            }else{
                _data.name = $(form + ' input.name').val();
            }

            $.ajax({
                url: "{{ route('outcash.store') }}",
                method: 'post',
                dataType: 'json',
                data: _data,
                beforeSend: function() {
                    $(form + ' .overlay').show();
                    $(form + ' .form-group').removeClass('has-error has-feedback');
                    $(form + ' .invalid-feedback').text('');
                },
                success: function(res) {
                    $(form + ' .overlay').hide();
                    Swal(res.t, res.m, res.s);
                    $(form)[0].reset();
                    init_form();

                },
                error: function(xhr, status, error) {
                    $(form + ' .overlay').hide();
                    $('#console').html(xhr.responseText);

                    let errors = xhr.responseJSON.errors;
                    $.each(errors, function(key, item) {
                        let group = form + ' .'+ key + '_group';
                        $(group).addClass('has-error has-feedback');
                        $(group +' .invalid-feedback').text(item);
                    });
                }
            });
        }
        
        init_form();
        function init_form(){
            let hideOnOwner = ['name_group', 'address_group', 'phone_group'];
            let hideOnNormal = ['owner_name_group'];
            let form = '#addLoanForm';
            
            let is_owner = $(form + ' select.is_owner').val();
            if(is_owner == 'Yes'){
                for(let i = 0; i < hideOnOwner.length; i++){
                    $(form + ' .' + hideOnOwner[i]).hide(300);
                }
                
                for(let i = 0; i < hideOnNormal.length; i++){
                    $(form + ' .' + hideOnNormal[i]).show(300);
                }
            }else{
                for(let i = 0; i < hideOnOwner.length; i++){
                    $(form + ' .' + hideOnOwner[i]).show(300);
                }
                
                for(let i = 0; i < hideOnNormal.length; i++){
                    $(form + ' .' + hideOnNormal[i]).hide(300);
                }
            }
        }
        
        function removeValidation(){
            $('.form-group').removeClass('has-feedback has-error');
            $('.invalid-feedback').text('');
        }


    });
</script>

@endsection
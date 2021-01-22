@extends('layouts.master')

@section('title')
  <title>Setting</title>
@endsection


@section('body')
  <section class="content-header">
      <h1>
        Setting
        <small>Controll Options</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="/"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active"><a href="#">Setting</a></li>
      </ol>
    </section>

    <section class="content">

      <!-- /.row -->
      <!-- Main row -->
      <div class="row">
        <!-- Left col -->
        <section class="col-lg-7 connectedSortable">
          <!-- Custom tabs (Charts with tabs)-->
          <div class="box box-solid ">
            <div class="box-header">
              <i class="fa fa-th"></i>

              <h3 class="box-title">Langauge Setting</h3>

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
                  <label for="lang" class="col-sm-3 control-label">Select One</label>

                  <div class="col-sm-9">
                    <select class="form-control" id="lang">
                      <option value="BN">বাংলা</option>
                      <option value="EN">English US</option>
                    </select>
                  </div>
                </div>

              </form>
              </div>
              <!-- /.box-body -->
              <div class="box-footer">
                <button type="submit" id="change_lang" class="btn btn-info pull-right">Confirm</button>
              </div>
              <!-- /.box-footer -->
          </div>


          <div class="box box-solid">
            <div class="box-header">
              <i class="fa fa-th"></i>

              <h3 class="box-title">Product Prise Setting</h3>

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
                  <label for="product" class="col-sm-3 control-label">select_product</label>

                  <div class="col-sm-9">
                    <select class="form-control" id="product">
                      <option value="">Select One</option>
                      <option value="Brick">Brick</option>
                      <option value="Khuwa">Khuwa</option>
                      <option value="Adla">Adla</option>
                    </select>
                  </div>
                </div>

                <div class="form-group">
                  <label for="quality" class="col-sm-3 control-label">select_quality</label>

                  <div class="col-sm-9">
                    <select class="form-control" id="quality">
                      <option value="">Select One</option>
                      <option value="A">A</option>
                      <option value="B">B</option>
                      <option value="C">C</option>
                    </select>
                  </div>
                </div>

                <div class="form-group">
                  <label for="rate" class="col-sm-3 control-label">rate</label>

                  <div class="col-sm-9">
                    <input type="text" class="form-control" id="rate" autocomplete="off" placeholder="rate">
                  </div>
                </div>
                </form>
              </div>

              <div class="box-footer">
                <button type="submit" id="update_rate" class="btn btn-info pull-right">confirm</button>
              </div>
          </div>


        </section>
        <!-- /.Left col -->
        <!-- right col (We are only adding the ID to make the widgets sortable)-->
        <section class="col-lg-5 connectedSortable">


          <!-- customer info -->
          <div class="box box-solid">
            <div class="box-header">
              <i class="fa fa-th"></i>

              <h3 class="box-title">import_database</h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn bg-teal btn-sm" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn bg-teal btn-sm" data-widget="remove"><i class="fa fa-times"></i>
                </button>
              </div>
            </div>

            <div class="box-body border-radius-none">
              <center><button class="btn btn-primary">import_database</button></center>
            </div>

          </div>



          <div class="box box-solid">
            <div class="box-header">
              <i class="fa fa-th"></i>

              <h3 class="box-title">download_document</h3>

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
                    <label for="downloadDate" class="col-sm-4 control-label">date</label>

                    <div class="col-sm-8">
                      <input type="text" placeholder="yyyy-mm-dd" class="form-control" id="downloadDate" data-toggle="datepiker">
                    </div>
                  </div>
                </form>
                <center>
                  <a class="inject_ladger btn btn-primary">ladger</a>
                  <a class="inject_cost btn btn-info">cost_vautcher</a>
                  <a class="inject_delevery btn btn-danger" href="downloads/print-delevery.php">delevery</a>
                </center>
              </div>

          </div>


          <div class="box box-solid">
            <div class="box-header">
              <i class="fa fa-th"></i>

              <h3 class="box-title">change_date</h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn bg-teal btn-sm" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn bg-teal btn-sm" data-widget="remove"><i class="fa fa-times"></i>
                </button>
              </div>
            </div>

              <div class="box-body border-radius-none">
                <form class="form-horizontal" id="dateChangeFrom">
                  <div class="form-group">
                    <label for="date" class="col-sm-4 control-label">date {{ Dates::UserDate() }}</label>

                    <div class="col-sm-8">
                      <input type="text" placeholder="yyyy-mm-dd" class="date form-control" data-toggle="datepiker">
                    </div>
                  </div>
              </div>
              <div class="dateChangeFrom box-footer">
                <button type="submit" class="changeDate btn btn-info pull-right">btn_confirm</button>
            </form>
                <button class="resetDefault btn btn-danger">reset_default</button>
              </div>

          </div>
        </section>
        <pre id="console"></pre>
      </div>
      <!-- /.row (main row) -->
    </section>
    
@endsection


    
@section('script')
  <script>
    $(document).ready(function() {
      $.ajaxSetup({
        headers : { 'X-CSRF-Token' : '{{ csrf_token() }}'}
      });
      
    $('#dateChangeFrom .date').val("{{ Dates::UserDate() }}");
      
    $('input[data-toggle="datepiker"]').datepicker({
        //dateFormat: 'y-m-d'
    });
    
    $('#dateChangeFrom').submit(function(e){
        e.preventDefault();
        let date = $('#dateChangeFrom .date').val();
        $.ajax({
            url : '{{ route('setting.date.update') }}',
            method : 'post',
            dataType : 'json',
            data : {
                date : date,
                query : 'set'
            },
            beforeSend: function(){
                
            },
            success: function(res){
                Swal(res.t, res.m, res.s);
            },
            error : function(xhr, status, error){
                $('#console').html(xhr.responseText);
            }
        });
    });
    
    $('.resetDefault').click(function(){
        $.ajax({
            url : '{{ route('setting.date.update') }}',
            method : 'post',
            dataType : 'json',
            data : {
                query : 'delete'
            },
            beforeSend: function(){
                
            },
            success: function(res){
                Swal(res.t, res.m, res.s);
            },
            error : function(xhr, status, error){
                $('#console').html(xhr.responseText);
            }
        });
    });
    
    
    
      
      
    });
  </script>

@endsection
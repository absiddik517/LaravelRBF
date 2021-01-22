<style>
    .overlay img{
        width: 30px;
        height: 30px;
    }
</style>

<div id="cashDetailsModal" class="modal fade" role="dialog">
      <div class="modal-dialog modal-lg">
      	<!-- modal content -->
      	<div class="modal-content">
      		<div class="overlay"><img src="{{ asset('images/system/spinner.jpg') }}"></div>
      		<div class="modal-header">
      			<button class="close closeBtn" type="button" data-dismiss="modal">&times;</button>
      			<h4 class="modal-title"></h4>
      		</div>
      		<!-- modal Body -->
      		<div class="modal-body">
      		</div>
      		<!-- modal footer -->
      		<div class="modal-footer">
      			<button class="btn btn-danger" data-dismiss="modal">{{ __('btn.cancel') }}</button>
      		</div>
      	</div>
      </div>
</div>

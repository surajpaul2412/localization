<!-- <button class="btn notifications btn-success" data-type="success" data-from="top" data-align="right">success</button> -->





<div class="alert-container">
    @if(session()->get('success'))
    <div class="alert alert-success alert-dismissible in" role="alert">
	    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
	    </button>
	    {{ session()->get('success') }}
	</div>
    @endif
    @if (session('error'))
    <div class="alert alert-danger alert-dismissible in" role="alert">
	    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
	    </button>
	    {{ session('error') }}
	</div>
    @endif
    @if (session('failure'))
    <div class="alert alert-danger alert-dismissible in" role="alert">
	    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
	    </button>
	    {{ session('failure') }}
	</div>
    @endif
    @if ($errors->any())
    <div class="alert alert-danger alert-dismissible in" role="alert">
	    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
	    </button>
	    {{ implode('', $errors->all(':message')) }}
	</div>
    @endif
</div>
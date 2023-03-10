


<!-- [ Alert Msg ] start -->
<div style="position:absolute; top:75px; right: 10px; z-index: 9999;">
    <!-- <div class="alert-container"> -->
    @if(session()->get('success'))
    <div class="alert alert-success alert-dismissible in" role="alert">{{ session()->get('success') }}</div>
    @endif
    @if (session('error'))
    <div class="alert alert-danger alert-dismissible in" role="alert">{{ session('error') }}</div>
    @endif
    @if (session('failure'))
    <div class="alert alert-danger alert-dismissible in" role="alert">{{ session('failure') }}</div>
    @endif
    @if ($errors->any())
    <div class="alert alert-danger alert-dismissible in" role="alert">
        {{ implode('', $errors->all(':message')) }}
    </div>
    @endif
</div>
<!-- [ Alert Msg ] End -->
<div class="alert-container">
    @if(session()->get('success'))
    <div class="alert alert-success" role="alert">{{ session()->get('success') }}</div>
    @endif
    @if (session('error'))
    <div class="alert alert-danger" role="alert">{{ session('error') }}</div>
    @endif
</div>
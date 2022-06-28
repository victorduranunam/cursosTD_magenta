@if (isSet($success))
    <div class="alert alert-success message" role=alert>
        <strong> {!! $success !!}</strong>
    </div>
@endif

@if (isSet($danger))
    <div class="alert alert-danger message" role=alert>
        <strong> {!! $danger !!}</strong>
    </div>
@endif

@if (isSet($info))
    <div class="alert alert-info message" role=alert>
        <strong> {!! $info !!}</strong>
    </div>
@endif

@if (isSet($warning))
    <div class="alert alert-warning message" role=alert>
        <strong> {!! $warning !!}</strong>
    </div>
@endif
@if (isSet($success))
    <div class="alert alert-success" role=alert>
        <strong> {!! $success !!}</strong>
    </div>
@endif

@if (isSet($danger))
    <div class="alert alert-danger" role=alert>
        <strong> {!! $danger !!}</strong>
    </div>
@endif

@if (isSet($info))
    <div class="alert alert-info" role=alert>
        <strong> {!! $info !!}</strong>
    </div>
@endif

@if (isSet($warning))
    <div class="alert alert-warning" role=alert>
        <strong> {!! $warning !!}</strong>
    </div>
@endif
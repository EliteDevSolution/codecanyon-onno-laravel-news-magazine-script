@php 
    $poll=Modules\Post\Entities\Poll::with('pollResults', 'pollOptions.pollresults')->where('id', $param[0])->first();
@endphp 

<div class="modal-body"> 
    <div class="form-group text-center">
        <label for="title" class="col-form-label"><b>{{ __('total_vote') }} : {{ $poll->pollResults->count() }}</b></label> 
    </div>

    @foreach($poll->pollOptions as $option)
        <label class="col-form-label"><b>{{ $option->option }}</b></label>
        @if($poll->pollResults->count() != 0 && $poll->pollResults->count() * 100 != 0)
        <div class="progress">
            <div class="progress-bar bg-primary" role="progressbar" aria-valuenow="{{ round($option->pollresults->count() / $poll->pollResults->count() * 100) }}"
                aria-valuemin="0" aria-valuemax="100" style="width:{{ round($option->pollresults->count() / $poll->pollResults->count() * 100) }}%">
                <span id="progress-bar-span">{{ round($option->pollresults->count() / $poll->pollResults->count() * 100) }}%</span>
            </div>
        </div>
        @else
        <div class="progress">
            <div class="progress-bar bg-primary" role="progressbar" aria-valuenow="0"
                aria-valuemin="0" aria-valuemax="100">
                <span id="progress-bar-span">0%</span>
            </div>
        </div>
        @endif

    @endforeach 

</div>
<div class="modal-footer">
    <button type="button" class="btn btn-light" data-dismiss="modal">{{ __('close') }}</button>
</div>

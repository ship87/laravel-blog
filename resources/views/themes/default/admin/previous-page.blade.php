<div class="form-group">
<a href="{{ url()->previous() }}">{{ u__('admin.back to previous page') }}</a>
    {{  Form::hidden('url_previous',URL::previous())  }}
</div>
@extends('original_admin.base')

@section('content')

<h1 class="h5">非承認した申請一覧</h1>
<div class="border border-primary p-3">
    <table class="table">
        <thead>
            <tr>
                <th scope="col">LINEアイコン</th>
                <th scope="col">LINE名</th>
                <th scope="col">申請したコトバム</th>
                <th scope="col">戻す</th>
                <th scope="col">完全に申請を却下</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($denials as $application)
            <tr>
                <td><img src="{{ $application->user->line_picture_url }}" width="30px"></td>
                <td>{{ $application->user->line_display_name }}</td>
                <td><a href="{{ route('kotobamu.link_from_followers', $application->kotobamu) }}">{{ $application->kotobamu->keyword }}</a></td>
                <td>
                    <form method="post" action="{{ route('application.update', $application) }}">
                        @csrf
                        @method('PATCH')
                        <input type="hidden" name="is_approved" value="null">
                        <input type="submit" value="元に戻す" class="btn btn-outline-primary">
                    </form>
                </td>
                <td>
                    <form action="{{ route('application.destroy', $application) }}" method="post">
                        @csrf
                        @method('DELETE')
                        <input type="submit" class="btn btn-outline-danger" value="完全に申請を却下">
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    @if(!count($denials))
    <p>非承認した申請はありません</p>
    @endif
</div>

@endsection

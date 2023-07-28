@if($errors->any())
    {{-- 연상배열이 아니라서 key가 필요없어서 빼줌 --}}
    {{-- all사용 이유 : 객체는 배열이 아니라서 배열처럼 만들어줌 --}}
    @foreach($errors->all() as $error) 
        <div style="color:red">{{$error}}</div>
    @endforeach
@endif
{{-- $errors 변수에 저장된 모든 오류 메시지를 출력 --}}

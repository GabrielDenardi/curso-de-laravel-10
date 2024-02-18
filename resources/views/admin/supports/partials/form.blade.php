@csrf
<input type="text" placeholder="assunto" name="subject" value="{{$support->subject ?? old('subject')}}">
<textarea name="body" cols="30" rows="5" placeholder="descricao">{{$support->body ?? old('body')}}</textarea>
<button type="submit">Enviar</button>

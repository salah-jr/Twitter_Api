<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Tweety</title>
    <link rel="stylesheet"  href="https://stackpath.bootstrapcdn.com/bootswatch/4.3.1/yeti/bootstrap.min.css">
    <link rel="stylesheet" href="css/custom.css">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <a class="navbar-brand" href="#">Tweety</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarColor01" aria-controls="navbarColor01" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
      
        <div class="collapse navbar-collapse" id="navbarColor01">
          <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
              <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
            </li>
          </ul>
        </div>
      </nav> 
      <br><br>
      <div class="container">
        <form class="card card-body bg-light" action="{{route('post.tweet')}}" method="POST" enctype="multipart/form-data">
            {{csrf_field()}}
            @if (count($errors)>0)
                @foreach ($errors->all() as $error)
                    <div class="alert alert-danger">
                        {{$error}}
                    </div>
                @endforeach
            @endif
            <div class="form-group">
                <label>Tweet text</label>
                <input type="text" name="tweet" class="form-control">
            </div>
            <div class="form-group">
                    <label>Upload Images</label>
                    <input type="file" name="images[]" multiple class="form-control">
            </div>
            <br>
            <div class="form-group">
                 <button class="btn btn-info my-2 my-sm-0">Create Tweet</button>
             </div>
        </form>
     </div>
     <br>
      <div class="container">
          @if(!empty($data))
            @foreach ($data as $tweet)
                <div class="card card-body bg-light">
                    <h3>{{$tweet['text']}} 
                        <span class="glyphicon glyphicon-heart" aria-hidden="true"></span>{{$tweet['favorite_count']}}
                         <i class="glyphicon glyphicon-repeat"></i>{{$tweet['retweet_count']}}
                    </h3>
                    @if (!empty($tweet['extended_entities']['media']))
                        @foreach ($tweet['extended_entities']['media'] as $i)
                            <img src="{{$i['media_url_https']}}" alt="" style="width:100px;">
                        @endforeach
                    @endif
                </div>
                <br>
            @endforeach
          @else
            <p>No Tweets Found!</p>
          @endif
      </div>
</body>
</html>
@if ($file->mime_type == 'audio/mpeg')
    <audio controls>
        <source src="{{ route('files.download', $file->short_url) }}" type="{{ $file->mime_type }}">
    </audio>
@elseif ($file->mime_type == 'video/mp4')
    <iframe src="{{ route('files.download', $file->short_url) }}" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
@elseif ($file->mime_type == 'application/pdf')
    <iframe src="{{ route('files.download', $file->short_url) }}" width="100%" height="600px"></iframe>
@elseif ($file->mime_type == 'image/png')
    <img src="{{ route('files.download', $file->short_url) }}" alt="{{ $file->title }}" class="img-fluid">
@endif

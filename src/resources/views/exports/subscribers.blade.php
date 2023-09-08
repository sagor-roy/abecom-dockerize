<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Email</th>
        </tr>
    </thead>
    <tbody>
        @foreach( $datas as $key => $data )
        <tr>
            <th>
                {{ $key + 1 }}
            </th>
            <th>
                {{ $data->email }}
            </th>
        </tr>
        @endforeach
        
    </tbody>
</table>
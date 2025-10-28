<div>
    <table class="w-full table-auto border border-gray-200">
        <thead>
            <tr class="bg-gray-100">
                <th class="px-4 py-2 text-left">Page URL</th>
                <th class="px-4 py-2 text-left">Visits</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($topPages as $page)
                <tr class="border-t border-gray-200">
                    <td class="px-4 py-2">{{ $page['page_url'] }}</td>
                    <td class="px-4 py-2">{{ $page['visits'] }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

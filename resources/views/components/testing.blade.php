<div {{ $attributes->merge(['class' => 'text-xl']) }}>
    <!-- Be present above all else. - Naval Ravikant -->
    <ul>
      <?php foreach ($list as $key => $value): ?>
        <li>{{ $value->building_block_name }}</li>
      <?php endforeach; ?>
    </ul>
</div>

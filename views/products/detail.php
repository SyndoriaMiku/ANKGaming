<?php include __DIR__ . '/../layout/header.php'; ?>
<h2> CPU Details </h2>
<p><strong>Name:</strong> <?=$product['name']?></p>
<p><strong>Core:</strong> <?=$product['core']?></p>
<p><strong>Thread:</strong> <?=$product['thread']?></p>
<p><strong>Base Clock:</strong> <?=$product['base_clock']?></p>
<p><strong>Boost Clock:</strong> <?=$product['boost_clock']?></p>
<p><strong>L1 Cache:</strong> <?=$product['cache_l1']?></p>
<p><strong>L2 Cache:</strong> <?=$product['cache_l2']?></p>
<p><strong>L3 Cache:</strong> <?=$product['cache_l3']?></p>
<p><strong>Socket:</strong> <?=$product['socket']?></p>
<p><strong>TDP:</strong> <?=$product['tdp']?></p>
<p><strong>Price:</strong> <?=$product['price']?></p>
<p><strong>Stock:</strong> <?=$product['stock']?></p>

<?php include __DIR__ . '/../layout/footer.php'; ?>
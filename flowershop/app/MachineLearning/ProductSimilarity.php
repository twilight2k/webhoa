<?php declare(strict_types=1);

namespace App\MachineLearning;

use Exception;

class ProductSimilarity
{
    protected $products       = [];
    protected $featureWeight  = 1;
    protected $priceWeight    = 1;
    protected $descriptionWeight = 1;
    protected $IdTypeWeight = 1;
    protected $unitWeight = 1;
    protected $priceHighRange = 1000;
    protected $categoryHighRange = 10;

    public function __construct(array $products)
    {
        $this->products       = $products;
        $this->priceHighRange = max(array_column($products, 'unit_price'));
    }

    public function setFeatureWeight(float $weight): void
    {
        $this->featureWeight = $weight;
    }

    public function setIdTypeWeight(float $weight):void
    {
        $this->IdTypeWeight = $weight;
    }

    public function setPriceWeight(float $weight): void
    {
        $this->priceWeight = $weight;
    }

    public function setDescriptionWeight(float $weight): void
    {
        $this->descriptionWeight = $weight;
    }
    public function setUnitWeight(float $weight): void
    {
        $this->unitWeight = $weight;
    }
    public function calculateSimilarityMatrix(): array
    {
        $matrix = [];

        foreach ($this->products as $product) {

            $similarityScores = [];

            foreach ($this->products as $_product) {
                if ($product->id === $_product->id) {
                    continue;
                }
                $similarityScores['product_id_' . $_product->id] = $this->calculateSimilarityScore($product, $_product);
            }
            $matrix['product_id_' . $product->id] = $similarityScores;
        }
        return $matrix;
    }

    public function getProductsSortedBySimularity(int $productId, array $matrix): array
    {
        $similarities   = $matrix['product_id_' . $productId] ?? null;
        $sortedProducts = [];

        if (is_null($similarities)) {
            throw new Exception('Không tìm thấy sản phẩm có ID này');
        }
        arsort($similarities);

        foreach ($similarities as $productIdKey => $similarity) {
            $id      = intval(str_replace('product_id_', '', $productIdKey));
            $products = array_filter($this->products, function ($product) use ($id) { return $product->id === $id; });
            if (! count($products)) {
                continue;
            }
            $product = $products[array_keys($products)[0]];
            $product->similarity = $similarity;
            $sortedProducts[] = $product;
        }
        return $sortedProducts;
    }

    protected function calculateSimilarityScore($productA, $productB)
    {
        //$productAFeatures = implode('', get_object_vars($productA->features));//Khai báo biến $productAFeatures // implode():có tác dụng nối các phần tử của mảng lại thành chuỗi, hàm sẽ trả về chuỗi bao gồm các phần tử của mảng được ngăn cách bằng một kí tự ('')
        //$productBFeatures = implode('', get_object_vars($productB->features));//--> get_object_vars($productB->features):Lấy đối tượng var = biến $productB->(trỏ tới)-> đặc trưng (features)
        
        return array_sum([
            //(Similarity::hamming($productAFeatures, $productBFeatures) * $this->featureWeight),
            (Similarity::euclidean(
                Similarity::minMaxNorm([$productA->id_type], 0, $this->categoryHighRange),
                Similarity::minMaxNorm([$productB->id_type], 0, $this->categoryHighRange)
            ) * $this->IdTypeWeight),
            (Similarity::euclidean(
                Similarity::minMaxNorm([$productA->unit_price], 0, $this->priceHighRange),
                Similarity::minMaxNorm([$productB->unit_price], 0, $this->priceHighRange)
            ) * $this->priceWeight),
            (Similarity::jaccard($productA->description, $productB->description) * $this->descriptionWeight),
            (Similarity::jaccard($productA->unit, $productB->unit) * $this->unitWeight)
            
        ]) / ($this->IdTypeWeight + $this->priceWeight + $this->descriptionWeight + $this->unitWeight);
    }
}
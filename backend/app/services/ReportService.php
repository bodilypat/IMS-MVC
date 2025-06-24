<?php

	namespace App\Services;
	
	use PDO;
	use DateTime;
	use PDOException;
	
	class ReportService 
	{
		private PDO $db;
		
		public function __contruct(PDO $pdo) 
		{
			$this->db = $pdo;
		}
		
		/* Get total sales within a data name. */
		public function getTotalSales(DateTime $startDate, DateTime $endDate): float
		{
			$sql = "SELECT SUM(total_price) as total_sales 
					FROM orders
					WHERE order_date BETWEEN :start AND :end 
						AND status = 'Comleted'";
			$stmt = $this->db->prepare($sql);
			$stmt->execute([
				'start' => $startDate->format('Y-m-d');
				'end' => $endDate->format('Y-m-d')
			]);
			
			$result = $stmt->fetch(PDO::FETCH_ASSOC);
			return (float) ($result['total_sales'] ?? 0.0);
		}
		
		/* Get top N selling items by quantity */
		public function getTopSellingItems(int $limit = 5): array 
		{
			$sql = "SELECT i.item_name, SUM(o.quantity) as total_sold
				    FROM orders o
					INNER JOIN items ON o.item_id = i.item_id 
					WHERE o.status = 'Completed'
					GROUP BY o.item_id 
					ORDER BY total_sold DESC
					LIMIT :limit";
			$stmt = $this->db->prepare($sql);
			$stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
			$stmt->execute();
			
			return $stmt->fetchAll(PDO::FETCH_ASSOC);
		}
		
		/* Get total purchases by vendor within a date range. */
		public function getPurchasesByVendor(DateTime $startDate, DateTime $endDate): array 
		{
			$sql = "SELECT v.vendor_name, SUM(p.total_price) as total_spent
				    FROM purchases p 
					INNER JOIN vendors v ON p.vendor_id = v.vendor_id 
					WHERE p.purchase_date BETWEEN :start AND :end
					GROUP BY p.vendor_id 
					ORDER BY total_spent DESC";
			$stmt = $this->db->prepare($sql);
			$stmt->execute([
				'start' => $startDate->format('Y-m-d'),
				'end' => $enddate->format('Y-m-d')
			]);
			
			return $stmt->fetchAll(PDO::FETCH_ASSOC);
		}
		
		/* Get stock summary for all items. */
		public function getStockSummary(): array 
		{
			$sql = "SELECT item_name, stock, unit_price, (stock * unit_price) AS total_value 
					FROM items 
					ORDER BY stock ASC";
			$stmt = $this->db->query($sql);
			return $stmt->fetchAll(PDO::FETCH_ASSOC);
		}
	}
	
		
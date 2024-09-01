<?php

	class modDefinitions{
		public static function getDefinitions($params){
		$document = JFactory::getDocument()->addStyleSheet("modules/mod_definitions/style.css");
			$db = JFactory::getDbo();

			// Create a new query object.
			$query = $db->getQuery(true);

			$sql = "SELECT #__content.id, #__content.title,  #__content.introtext
					FROM #__content,#__categories
					WHERE `introtext` LIKE '%<dfn%' 
					AND #__categories.id = #__content.catid
					and #__content.state=1
					ORDER BY #__content.id DESC";
				$db = JFactory::getDBO();
				$db->setQuery($sql);
				$row = $db->loadObjectList();
				
				$str = '<div class="liste-definitions">';
				$str .='<div class="titre">'.$params->get("titre").'</div>';
				$i=0;
				foreach($row as $uneDef)
				{
					$re = '/<dfn.*>(.*)<\/dfn>.*<abbr.*title\s*?=\s*?"(.*)".*>(.*)<\/abbr>.*<span\s*class\s*?=\s*?"definition">(.*)<\/span>/msU';
					preg_match_all($re, $uneDef->introtext, $matches, PREG_SET_ORDER, 0);

					foreach($matches as $unMotDefini)
					{
						/*echo "<pre>";
						print_r($unMotDefini);
						echo "</pre>";*/
						$str .= "<div class=\"glossary-item\">\r\n";
						$str .= "\t<span class=\"article-id\">".$uneDef->id."</span>\r\n";
						$str .= "\t<span class=\"article-title\">".$uneDef->title."</span>\r\n";
						$str .= "\t<span class=\"mot-defini\">".$unMotDefini[1]."</span>\r\n";
						$str .= "\t<span class=\"abbreviation\">".$unMotDefini[3]."</span>\r\n";
						$str .= "\t<span class=\"definition\">".$unMotDefini[4]."</span>\r\n";
						$str .= "</div>";
					}
					
				}
				$i++;
				$str.= '</div>';
				
				echo $str;
		}
	}
?>
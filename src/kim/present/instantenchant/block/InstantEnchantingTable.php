<?php

/*
 *
 *  ____                           _   _  ___
 * |  _ \ _ __ ___  ___  ___ _ __ | |_| |/ (_)_ __ ___
 * | |_) | '__/ _ \/ __|/ _ \ '_ \| __| ' /| | '_ ` _ \
 * |  __/| | |  __/\__ \  __/ | | | |_| . \| | | | | | |
 * |_|   |_|  \___||___/\___|_| |_|\__|_|\_\_|_| |_| |_|
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU Affero General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * @author  PresentKim (debe3721@gmail.com)
 * @link    https://github.com/PresentKim
 * @license https://www.gnu.org/licenses/agpl-3.0.html AGPL-3.0.0
 *
 *   (\ /)
 *  ( . .) ♥
 *  c(")(")
 */

declare(strict_types=1);

namespace kim\present\instantenchant\block;

use pocketmine\block\BlockFactory;
use pocketmine\block\EnchantingTable;
use pocketmine\item\Item;
use pocketmine\Player;

class InstantEnchantingTable extends EnchantingTable{
	/**
	 * Initializes the instant enchanting table.
	 * Register instant enchanting table to block factory.
	 */
	public static function init() : void{
		BlockFactory::registerBlock(new InstantEnchantingTable(), true);
	}

	/**
	 * @param Item        $item
	 * @param Player|null $player
	 *
	 * @return bool
	 */
	public function onActivate(Item $item, Player $player = null) : bool{
		if($player instanceof Player){
			$newItem = clone $item;
			$newItem->count = 1;
			--$item->count;

			$inventory = $player->getInventory();
			if(!$player->isCreative(true)){
				//Requires level 30.
				if($player->getXpLevel() < 30){
					$player->sendMessage("[InstantEnchant] Requires level 30");
					return true;
				}
				//Remove level 30
				$player->setXpLevel($player->getXpLevel() - 30);

				//Requires 30 lapis lazuli
				$lapisLazuli = Item::get(Item::DYE, 4);
				$count = 0;
				foreach($inventory->getContents() as $key => $content){
					if($content->equals($lapisLazuli, true, true)){
						$count += $content->count;
						if($count <= 30){
							break;
						}
					}
				}
				if($count < 30){
					$player->sendMessage("[InstantEnchant] Requires 30 lapis lazuli");
					return true;
				}

				//Remove 30 lapis lazuli
				$count = 30;
				foreach($inventory->getContents(true) as $slot => $content){
					if($content->equals($lapisLazuli, true, true)){
						if($content->count >= $count){
							$content->count -= $count;
							$count = 0;
							$inventory->setItem($slot, $content);
						}else{
							$count -= $content->count;
							$inventory->clear($slot);
						}
						if($count <= 0){
							break;
						}
					}
				}
			}

			//TODO: Implements enchanting

			$inventory->addItem($newItem);
		}
		return true;
	}
}

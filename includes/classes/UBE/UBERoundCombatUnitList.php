<?php

/**
 * Class UBERoundCombatUnitList
 *
 * @method UBERoundCombatUnit offsetGet($offset)
 * @property UBERoundCombatUnit[] $_container
 */
class UBERoundCombatUnitList extends ArrayAccessV2 {

  public function __clone() {
    parent::__clone(); // TODO: Change the autogenerated stub
  }


  /**
   * @param UBEFleet $UBEFleet
   */
  public function init_from_UBEFleet(UBEFleet $UBEFleet) {
    foreach($UBEFleet->unit_list->_container as $unit_id => $UBEFleetUnit) {
      // Копируем информацию о кораблях в первый раунд
      $this[$unit_id] = new UBERoundCombatUnit();
      $this[$unit_id]->init_from_UBEFleetUnit($UBEFleetUnit);
    }
  }

  /**
   * @param UBERoundFleetCombat $source
   */
  public function init_from_UBERoundFleetCombat(UBERoundFleetCombat $source) {
    foreach($source->unit_list->_container as $unit_id => $UBERoundCombatUnit) {
      if(empty($UBERoundCombatUnit->count) || $UBERoundCombatUnit->count <= 0) {
        continue;
      }

      // Копируем информацию о кораблях в первый раунд
      $this[$unit_id] = new UBERoundCombatUnit();
      $this[$unit_id]->init_from_UBERoundCombatUnit($UBERoundCombatUnit);
    }
  }

  /**
   * @return int
   */
  public function get_reapers() {
    $reapers = 0;

    foreach($this->_container as $unit_id => $UBERoundCombatUnit) {
      // TODO: Работа по группам - группа "Уничтожители лун"
      if($UBERoundCombatUnit->unit_id == SHIP_HUGE_DEATH_STAR) {
        $reapers += $UBERoundCombatUnit->count;
      }
    }

    return $reapers;
  }


  /**
   * @param array $sql_perform_ube_report_unit
   * @param int   $unit_sort_order
   * @param array $prefix
   */
  // OK6
  public function sql_generate_unit_array(array &$sql_perform_ube_report_unit, &$unit_sort_order, array &$prefix) {
    foreach($this->_container as $unit_id => $UBERoundCombatUnit) {
      $sql_perform_ube_report_unit[] = array_merge(
        $prefix,
        $UBERoundCombatUnit->sql_generate_unit_array(),
        array($unit_sort_order++)
      );
    }
  }

  /**
   * @param UBEFleet $fleet_info
   * @param bool     $is_simulator
   */
  // OK3
  public function load_unit_info_from_UBEFleet(UBEFleet $fleet_info, $is_simulator) {
    foreach($this->_container as $unit_id => $UBERoundCombatUnit) {
      if($UBERoundCombatUnit->count <= 0) {
        continue;
      }

      $UBERoundCombatUnit->load_unit_info_from_UBEFleet($fleet_info->unit_list[$unit_id], $is_simulator);
    }
  }
}
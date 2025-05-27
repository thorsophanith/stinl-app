<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Standard;
use App\Models\parameter;
use App\Models\standard_parameter;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        // Standard::factory()->create([
        //     'code' => 'STD-001',
        //     'codex' => 'STD-001-FS',
        //     'name_en' => 'Fish Sauce Standard',
        //     'name_kh' => 'ស្តង់ដារនំជ្រក់ត្រី',
        // ]);

        // Standard::factory()->create([
        //     'code' => 'STD-002',
        //     'codex' => 'STD-002-DW',
        //     'name_en' => 'Drinking Water Quality Standard',
        //     'name_kh' => 'ស្តង់ដារទឹកផឹកមានគុណភាព',
        // ]);

        // Standard::factory()->create([
        //     'code' => 'STD-003',
        //     'codex' => 'STD-003-CS',
        //     'name_en' => 'Cheese Product Safety Standard',
        //     'name_kh' => 'ស្តង់ដារ​សុវត្ថិភាព​ផលិតផល​ឈីស',
        // ]);

        // Standard::factory()->create([
        //     'code' => 'STD-004',
        //     'codex' => 'STD-004-IC',
        //     'name_en' => 'Ice Cream Hygiene Standard',
        //     'name_kh' => 'ស្តង់ដារ​អនាម័យ​នៃការ​ផលិត​ការ៉េម',
        // ]);

        // Standard::factory()->create([
        //     'code' => 'STD-005',
        //     'codex' => 'STD-005-RI',
        //     'name_en' => 'Rice Export Quality Standard',
        //     'name_kh' => 'ស្តង់ដារគុណភាពអង្ករការនាំចេញ',
        // ]);

        // Standard::factory()->create([
        //     'code' => 'STD-006',
        //     'codex' => 'STD-006-BR',
        //     'name_en' => 'Bread Production Standard',
        //     'name_kh' => 'ស្តង់ដារផលិតនំប៉័ង',
        // ]);

        // Standard::factory()->create([
        //     'code' => 'STD-007',
        //     'codex' => 'STD-007-MS',
        //     'name_en' => 'Milk and Dairy Standard',
        //     'name_kh' => 'ស្តង់ដារ​ទឹកដោះគោ និងផលិតផលទឹកដោះគោ',
        // ]);

        // parameter::factory()->create([
        //     'name_en' => 'Glucose and Xylose',
        //     'name_kh' => 'ក្លូកូស និង ហ្ស៊ីឡូស',
        //     'formular' => 'C12H22O11',
        //     'criteria_operator' => '>=',
        //     'criteria_value1' => 0.5,
        //     'criteria_value2' => null,
        //     'unit' => 'mg/kg',
        //     'LOQ' => '0.1',
        //     'method' => 'HPLC',
        // ]);

        // parameter::factory()->create([
        //     'name_en' => 'Protein',
        //     'name_kh' => 'ប្រូតេអ៊ីន',
        //     'formular' => 'N/A',
        //     'criteria_operator' => '>=',
        //     'criteria_value1' => 10.0,
        //     'criteria_value2' => null,
        //     'unit' => 'g/100g',
        //     'LOQ' => '0.5',
        //     'method' => 'Kjeldahl',
        // ]);

        // parameter::factory()->create([
        //     'name_en' => 'pH Level',
        //     'name_kh' => 'កម្រិត pH',
        //     'formular' => 'N/A',
        //     'criteria_operator' => 'between',
        //     'criteria_value1' => 4.0,
        //     'criteria_value2' => 7.0,
        //     'unit' => 'pH',
        //     'LOQ' => '0.1',
        //     'method' => 'pH Meter',
        // ]);

        // parameter::factory()->create([
        //     'name_en' => 'Lead (Pb)',
        //     'name_kh' => 'ប្ដាប់សារ (Pb)',
        //     'formular' => 'Pb',
        //     'criteria_operator' => '<=',
        //     'criteria_value1' => 0.05,
        //     'criteria_value2' => null,
        //     'unit' => 'mg/kg',
        //     'LOQ' => '0.01',
        //     'method' => 'ICP-MS',
        // ]);

        // parameter::factory()->create([
        //     'name_en' => 'Arsenic (As)',
        //     'name_kh' => 'អាសេនិច (As)',
        //     'formular' => 'As',
        //     'criteria_operator' => '<=',
        //     'criteria_value1' => 0.1,
        //     'criteria_value2' => null,
        //     'unit' => 'mg/kg',
        //     'LOQ' => '0.01',
        //     'method' => 'ICP-MS',
        // ]);

        // parameter::factory()->create([
        //     'name_en' => 'Moisture Content',
        //     'name_kh' => 'មាតិកាសំណើម',
        //     'formular' => 'H2O',
        //     'criteria_operator' => '<=',
        //     'criteria_value1' => 12.0,
        //     'criteria_value2' => null,
        //     'unit' => '%',
        //     'LOQ' => '0.5',
        //     'method' => 'Oven Drying',
        // ]);

        // parameter::factory()->create([
        //     'name_en' => 'Total Fat',
        //     'name_kh' => 'ជាតិខ្លាញ់សរុប',
        //     'formular' => 'N/A',
        //     'criteria_operator' => '<=',
        //     'criteria_value1' => 30.0,
        //     'criteria_value2' => null,
        //     'unit' => 'g/100g',
        //     'LOQ' => '0.2',
        //     'method' => 'Soxhlet Extraction',
        // ]);

        // parameter::factory()->create([
        //     'name_en' => 'Sodium (Na)',
        //     'name_kh' => 'សូដ្យូម (Na)',
        //     'formular' => 'Na',
        //     'criteria_operator' => '<=',
        //     'criteria_value1' => 500,
        //     'criteria_value2' => null,
        //     'unit' => 'mg/kg',
        //     'LOQ' => '0.05',
        //     'method' => 'AAS',
        // ]);

        standard_parameter::factory()->count(20)->create();
    }
}

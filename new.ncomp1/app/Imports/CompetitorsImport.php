<?php

namespace App\Imports;

use App\Models\Competitor;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;

class CompetitorsImport implements ToModel, WithHeadingRow, WithValidation
{
    use Importable;

    /**
     * Transform each row into a Competitor model instance.
     *
     * @param array $row
     * @return Competitor|null
     */
    public function model(array $row)
    {
        return new Competitor([
            'full_name'           => $row['full_name'],
            'id_card_number'      => $row['id_card_number'],
            'address'             => $row['address'],
            'island_city'         => $row['island_city'],
            'school_name'         => $row['school_name'] ?? null,
            'parent_name'         => $row['parent_name'],
            'phone_number'        => $row['phone_number'],
            'competition_id'      => $row['competition_id'],
            'side_category_id'    => $row['side_category_id'],
            'read_category_id'    => $row['read_category_id'],
            'age_category_id'     => $row['age_category_id'],
            'number_of_questions' => $row['number_of_questions'],
        ]);
    }

    /**
     * Define validation rules for each row.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            '*.full_name'            => 'required',
            '*.id_card_number'       => 'required',
            '*.address'              => 'required',
            '*.island_city'          => 'required',
            '*.school_name'          => 'nullable',
            '*.parent_name'          => 'required',
            '*.phone_number'         => 'required',
            '*.competition_id'       => 'required',
            '*.side_category_id'     => 'required',
            '*.read_category_id'     => 'required',
            '*.age_category_id'      => 'required',
            '*.number_of_questions'  => 'required',
        ];
    }

    /**
     * Customize validation messages.
     *
     * @return array
     */
    public function customValidationMessages()
    {
        return [
            '*.full_name.required'       => 'Full Name is required.',
            '*.id_card_number.required'  => 'ID Card Number is required.',
            '*.id_card_number.unique'    => 'ID Card Number must be unique.',
            '*.address.required'         => 'Address is required.',
            '*.island_city.required'     => 'Island/City is required.',
            '*.parent_name.required'     => 'Parent Name is required.',
            '*.phone_number.required'    => 'Phone Number is required.',
            '*.competition_id.required'  => 'Competition ID is required.',
            '*.competition_id.exists'    => 'The selected competition does not exist.',
            '*.side_category_id.required'=> 'Side Category ID is required.',
            '*.side_category_id.exists'  => 'The selected side category does not exist.',
            '*.read_category_id.required'=> 'Read Category ID is required.',
            '*.read_category_id.exists'  => 'The selected read category does not exist.',
            '*.age_category_id.required' => 'Age Category ID is required.',
            '*.age_category_id.exists'   => 'The selected age category does not exist.',
            '*.number_of_questions.required' => 'Number of Questions is required.',
            '*.number_of_questions.integer'  => 'Number of Questions must be a valid number.',
            '*.number_of_questions.min'      => 'Number of Questions must be at least 1.',
            '*.number_of_questions.max'      => 'Number of Questions must not exceed 100.',
        ];
    }
}

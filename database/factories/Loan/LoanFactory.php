<?php

namespace Database\Factories\Loan;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Loan\Loan>
 */
class LoanFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $loanDate = $this->faker->dateTimeBetween('-1 month', 'now');
        $isReturned = $this->faker->boolean(50);

        return [
            'user_id'    => User::inRandomOrder()->first()->id ?? User::factory(),
            'book_id'    => Book::inRandomOrder()->first()->id ?? Book::factory(),
            'loan_date'  => $loanDate,
            'return_date'=> $isReturned ? $this->faker->dateTimeBetween($loanDate, 'now') : null,
            'status'     => $isReturned
                                ? $this->faker->randomElement(['returned', 'late'])
                                : 'borrowed',
        ];
    }
}

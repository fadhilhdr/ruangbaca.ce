<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BookSeeder extends Seeder
{
    public function run()
    {
        DB::table('books')->insert([
            [
                'isbn' => '978-01341904401',
                'title' => 'Introduction to Algorithms',
                'author' => 'Thomas H. Cormen',
                'total_stock' => 5,
                'available_stock' => 5,
                'thumbnail' => 'book-thumbnails/thumbnail1.png', // Path relatif untuk akses publik
                'specialization_id' => 1, // Software
                'synopsis' => 'A comprehensive guide to algorithms and data structures.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'isbn' => '978-14919503572',
                'title' => 'Python for Data Analysis',
                'author' => 'Wes McKinney',
                'total_stock' => 7,
                'available_stock' => 7,
                'thumbnail' => null,
                'specialization_id' => 1, // Software
                'synopsis' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'isbn' => '978-11192827163',
                'title' => 'Networking All-in-One For Dummies',
                'author' => 'Doug Lowe',
                'total_stock' => 10,
                'available_stock' => 10,
                'thumbnail' => null,
                'specialization_id' => 2, // Networking
                'synopsis' => 'A comprehensive overview of networking concepts and tools.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'isbn' => '978-01358860414',
                'title' => 'Computer Networking: A Top-Down Approach',
                'author' => 'James F. Kurose',
                'total_stock' => 3,
                'available_stock' => 3,
                'thumbnail' => null,
                'specialization_id' => 2, // Networking
                'synopsis' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'isbn' => '978-01311036275',
                'title' => 'The C Programming Language',
                'author' => 'Brian W. Kernighan',
                'total_stock' => 8,
                'available_stock' => 8,
                'thumbnail' => null,
                'specialization_id' => 1, // Software
                'synopsis' => 'A foundational guide to programming in C.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'isbn' => '978-02016336106',
                'title' => 'Design Patterns: Elements of Reusable Object-Oriented Software',
                'author' => 'Erich Gamma',
                'total_stock' => 4,
                'available_stock' => 4,
                'thumbnail' => null,
                'specialization_id' => 1, // Software
                'synopsis' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'isbn' => '978-03211274267',
                'title' => 'Domain-Driven Design: Tackling Complexity in the Heart of Software',
                'author' => 'Eric Evans',
                'total_stock' => 6,
                'available_stock' => 6,
                'thumbnail' => null,
                'specialization_id' => 1, // Software
                'synopsis' => 'A deep dive into the principles of domain-driven design.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'isbn' => '978-14919042448',
                'title' => 'Learning React',
                'author' => 'Alex Banks',
                'total_stock' => 8,
                'available_stock' => 8,
                'thumbnail' => null,
                'specialization_id' => 3, // Multimedia
                'synopsis' => 'An essential guide to React.js for developers.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'isbn' => '978-01323508849',
                'title' => 'Clean Code',
                'author' => 'Robert C. Martin',
                'total_stock' => 7,
                'available_stock' => 7,
                'thumbnail' => null,
                'specialization_id' => 1, // Software
                'synopsis' => 'A handbook of agile software craftsmanship.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'isbn' => '978-14919520238',
                'title' => 'Programming Embedded Systems',
                'author' => 'Michael Barr',
                'total_stock' => 5,
                'available_stock' => 5,
                'thumbnail' => null,
                'specialization_id' => 4, // Embedded System
                'synopsis' => 'An introduction to embedded system programming.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'isbn' => '978-01340926697',
                'title' => 'Artificial Intelligence: A Modern Approach',
                'author' => 'Stuart Russell',
                'total_stock' => 4,
                'available_stock' => 4,
                'thumbnail' => null,
                'specialization_id' => 1, // Software
                'synopsis' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'isbn' => '978-05960071266',
                'title' => 'Head First Design Patterns',
                'author' => 'Eric Freeman',
                'total_stock' => 2,
                'available_stock' => 2,
                'thumbnail' => null,
                'specialization_id' => 1, // Software
                'synopsis' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'isbn' => '978-14493613275',
                'title' => 'Interactive Data Visualization for the Web',
                'author' => 'Scott Murray',
                'total_stock' => 4,
                'available_stock' => 4,
                'thumbnail' => null,
                'specialization_id' => 3, // Multimedia
                'synopsis' => 'A guide to creating interactive visualizations with D3.js.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'isbn' => '978-01346859914',
                'title' => 'Effective Java',
                'author' => 'Joshua Bloch',
                'total_stock' => 3,
                'available_stock' => 3,
                'thumbnail' => null,
                'specialization_id' => 1, // Software
                'synopsis' => 'Best practices for programming in Java.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'isbn' => '978-01341773043',
                'title' => 'Introduction to Embedded Systems',
                'author' => 'Edward A. Lee',
                'total_stock' => 6,
                'available_stock' => 6,
                'thumbnail' => null,
                'specialization_id' => 4, // Embedded System
                'synopsis' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'isbn' => '978-02620338482',
                'title' => 'Structure and Interpretation of Computer Programs',
                'author' => 'Harold Abelson',
                'total_stock' => 4,
                'available_stock' => 4,
                'thumbnail' => null,
                'specialization_id' => 1, // Software
                'synopsis' => 'A textbook focusing on software design and development principles.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'isbn' => '978-02014856771',
                'title' => 'The Art of Computer Programming, Volume 1',
                'author' => 'Donald E. Knuth',
                'total_stock' => 5,
                'available_stock' => 5,
                'thumbnail' => null,
                'specialization_id' => 1, // Software
                'synopsis' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'isbn' => '978-01321269531',
                'title' => 'Introduction to Wireless and Mobile Systems',
                'author' => 'Dharma P. Agrawal',
                'total_stock' => 3,
                'available_stock' => 3,
                'thumbnail' => null,
                'specialization_id' => 2, // Networking
                'synopsis' => 'An introductory guide to wireless communication and mobile networks.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'isbn' => '978-11186564232',
                'title' => 'Networking Essentials',
                'author' => 'Jeffrey S. Beasley',
                'total_stock' => 6,
                'available_stock' => 6,
                'thumbnail' => null,
                'specialization_id' => 2, // Networking
                'synopsis' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'isbn' => '978-01237451493',
                'title' => 'Computer Graphics: Principles and Practice',
                'author' => 'John F. Hughes',
                'total_stock' => 7,
                'available_stock' => 7,
                'thumbnail' => null,
                'specialization_id' => 3, // Multimedia
                'synopsis' => 'A foundational text for learning computer graphics.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'isbn' => '978-01360066334',
                'title' => 'Digital Media: Concepts and Applications',
                'author' => 'Tay Vaughan',
                'total_stock' => 2,
                'available_stock' => 2,
                'thumbnail' => null,
                'specialization_id' => 3, // Multimedia
                'synopsis' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'isbn' => '978-15932759905',
                'title' => 'Eloquent JavaScript',
                'author' => 'Marijn Haverbeke',
                'total_stock' => 5,
                'available_stock' => 5,
                'thumbnail' => null,
                'specialization_id' => 1, // Software
                'synopsis' => 'A modern introduction to JavaScript programming.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'isbn' => '978-14920762626',
                'title' => 'Building Embedded Systems',
                'author' => 'Changyi Gu',
                'total_stock' => 3,
                'available_stock' => 3,
                'thumbnail' => null,
                'specialization_id' => 4, // Embedded System
                'synopsis' => 'Practical techniques for designing and deploying embedded systems.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'isbn' => '978-16839246477',
                'title' => 'Networking Basics',
                'author' => 'Mark Ciampa',
                'total_stock' => 6,
                'available_stock' => 6,
                'thumbnail' => null,
                'specialization_id' => 2, // Networking
                'synopsis' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'isbn' => '978-01370810738',
                'title' => 'Designing Embedded Systems with PIC Microcontrollers',
                'author' => 'Tim Wilmshurst',
                'total_stock' => 4,
                'available_stock' => 4,
                'thumbnail' => null,
                'specialization_id' => 4, // Embedded System
                'synopsis' => 'A hands-on approach to embedded design with PIC microcontrollers.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'isbn' => '978-14842522009',
                'title' => 'Pro JavaScript Design Patterns',
                'author' => 'Dustin Diaz',
                'total_stock' => 3,
                'available_stock' => 3,
                'thumbnail' => null,
                'specialization_id' => 3, // Multimedia
                'synopsis' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'isbn' => '978-03213496069',
                'title' => 'Refactoring: Improving the Design of Existing Code',
                'author' => 'Martin Fowler',
                'total_stock' => 5,
                'available_stock' => 5,
                'thumbnail' => null,
                'specialization_id' => 1, // Software
                'synopsis' => 'A practical guide to improving software design through refactoring.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'isbn' => '978-14842522001',
                'title' => 'Principles of Computer System Design',
                'author' => 'Jerome H. Saltzer',
                'total_stock' => 2,
                'available_stock' => 2,
                'thumbnail' => null,
                'specialization_id' => 1, // Software
                'synopsis' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'isbn' => '978-01348782498',
                'title' => 'Modern Embedded Computing',
                'author' => 'Peter Barry',
                'total_stock' => 6,
                'available_stock' => 6,
                'thumbnail' => null,
                'specialization_id' => 4, // Embedded System
                'synopsis' => 'A guide to embedded systems programming with modern tools.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'isbn' => '978-01346859917',
                'title' => 'Programming Languages: Principles and Practice',
                'author' => 'Kenneth C. Louden',
                'total_stock' => 2,
                'available_stock' => 2,
                'thumbnail' => null,
                'specialization_id' => 1, // Software
                'synopsis' => 'An introduction to the principles of programming languages.',
                'created_at' => now(),
                'updated_at' => now(),
            ],            
        ]);           
    }
}

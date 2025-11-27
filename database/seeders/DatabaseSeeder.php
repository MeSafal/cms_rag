<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Clear existing data
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('teams')->truncate();
        DB::table('team_roles')->truncate();
        DB::table('services')->truncate();
        DB::table('coachings')->truncate();
        DB::table('articles')->truncate();
        DB::table('blogs')->truncate();
        DB::table('data_embeddings')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        // Seed Team Roles
        $roles = [
            ['id' => 1, 'name' => 'Managing Director', 'slug' => 'managing-director', 'level' => 1],
            ['id' => 2, 'name' => 'Senior Robotics Engineer', 'slug' => 'senior-robotics-engineer', 'level' => 2],
            ['id' => 3, 'name' => 'AI/ML Specialist', 'slug' => 'ai-ml-specialist', 'level' => 3],
            ['id' => 4, 'name' => 'Training Coordinator', 'slug' => 'training-coordinator', 'level' => 3],
        ];
        DB::table('team_roles')->insert($roles);

        // Seed Teams
        $teams = [
            ['name' => 'Gokul Subedi', 'email' => 'gokul@visobotics.com', 'phone' => '9851234567', 'team_role_id' => 1, 'bio' => 'Managing Director and founder of Visobotics with 15+ years in robotics automation and AI. Visionary leader driving innovation in industrial robotics and autonomous systems.', 'order' => 1, 'active' => true],
            ['name' => 'Rajesh Kumar', 'email' => 'rajesh@visobotics.com', 'phone' => '9851234568', 'team_role_id' => 2, 'bio' => 'Senior Robotics Engineer specializing in robotic arm design and control systems. Expert in ROS, computer vision, and sensor integration.', 'order' => 2, 'active' => true],
            ['name' => 'Priya Sharma', 'email' => 'priya@visobotics.com', 'phone' => '9851234569', 'team_role_id' => 3, 'bio' => 'AI/ML Specialist focused on machine learning for robotics, deep learning, and neural networks. Published researcher in autonomous navigation.', 'order' => 3, 'active' => true],
            ['name' => 'Anil Thapa', 'email' => 'anil@visobotics.com', 'phone' => '9851234570', 'team_role_id' => 4, 'bio' => 'Training Coordinator with passion for education in robotics. Conducts hands-on workshops on Arduino, Raspberry Pi, and Python programming.', 'order' => 4, 'active' => true],
        ];
        DB::table('teams')->insert($teams);

        // Seed Services
        $services = [
            ['title' => 'Industrial Automation Solutions', 'description' => 'End-to-end industrial automation using robotic arms, conveyor systems, and PLC integration. We design and deploy custom automation solutions for manufacturing, warehousing, and logistics.', 'order' => 1, 'active' => true],
            ['title' => 'Custom Robotics Development', 'description' => 'Custom robot design and development tailored to your specific needs. From autonomous mobile robots to collaborative cobots, we build innovative solutions.', 'order' => 2, 'active' => true],
            ['title' => 'AI & Computer Vision Integration', 'description' => 'AI-powered computer vision systems for quality inspection, object detection, and intelligent decision-making in robotic applications.', 'order' => 3, 'active' => true],
            ['title' => 'IoT & Smart Systems', 'description' => 'IoT-enabled smart systems connecting robots to cloud platforms for remote monitoring, predictive maintenance, and data analytics.', 'order' => 4, 'active' => true],
            ['title' => 'Robotics Consulting', 'description' => 'Expert consulting services for robotics adoption, feasibility studies, ROI analysis, and technology roadmap planning for businesses.', 'order' => 5, 'active' => true],
        ];
        DB::table('services')->insert($services);

        // Seed Coachings (Robotics Training Programs)
        $coachings = [
            ['title' => 'Python for Robotics', 'description' => 'Comprehensive Python programming course focused on robotics applications. Learn Python basics, NumPy, OpenCV, and robot control libraries. Hands-on projects with simulated and real robots.', 'created_at' => now(), 'updated_at' => now()],
            ['title' => 'ROS (Robot Operating System) Fundamentals', 'description' => 'Master ROS for robot development. Topics include nodes, topics, services, tf, navigation stack, and SLAM. Work with Gazebo simulator and real robot hardware.', 'created_at' => now(), 'updated_at' => now()],
            ['title' => 'Arduino & Robotics Workshop', 'description' => 'Hands-on workshop covering Arduino programming, sensors, motors, and building autonomous robots from scratch. Perfect for beginners interested in robotics.', 'created_at' => now(), 'updated_at' => now()],
            ['title' => 'Machine Learning for Robotics', 'description' => 'Learn how to apply machine learning and deep learning in robotics. Object detection with YOLO, reinforcement learning, and neural network training for robot perception.', 'created_at' => now(), 'updated_at' => now()],
            ['title' => 'Advanced Robotic Arm Programming', 'description' => 'Deep dive into robotic arm kinematics, inverse kinematics, trajectory planning, and control. Program industrial robots using Python and ROS.', 'created_at' => now(), 'updated_at' => now()],
        ];
        DB::table('coachings')->insert($coachings);

        // Seed Articles
        $articles = [
            ['title' => 'About Visobotics', 'description' => 'Visobotics is Nepal\'s leading robotics and automation company, pioneering the future of intelligent systems. Founded in 2015, we specialize in industrial automation, AI-powered robotics, and cutting-edge training programs. Our mission is to make robotics accessible and transform industries through automation.', 'alias' => 'about-us', 'created_at' => now(), 'updated_at' => now()],
            ['title' => 'Our Mission', 'description' => 'Our mission at Visobotics is to democratize robotics technology and empower businesses with intelligent automation. We believe in innovation, sustainability, and excellence in everything we build.', 'alias' => 'our-mission', 'created_at' => now(), 'updated_at' => now()],
            ['title' => 'Why Choose Visobotics', 'description' => 'With 8+ years of expertise, 100+ successful automation projects, and a team of world-class robotics engineers, Visobotics is your trusted partner for robotics solutions. We deliver excellence, innovation, and reliable support.', 'alias' => 'why-choose-us', 'created_at' => now(), 'updated_at' => now()],
        ];
        DB::table('articles')->insert($articles);

        // Seed Blogs
        $blogs = [
            ['title' => 'Top 5 Robotics Trends in 2024', 'description' => 'Explore the latest trends in robotics including collaborative robots, AI integration, autonomous systems, and Industry 4.0 transformation. Learn how these technologies are reshaping manufacturing and logistics.', 'alias' => 'robotics-trends-2024', 'author' => 'Gokul Subedi', 'created_at' => now(), 'updated_at' => now()],
            ['title' => 'Getting Started with ROS: A Beginner\'s Guide', 'description' => 'Complete beginner-friendly guide to Robot Operating System (ROS). Installation, basic concepts, creating your first node, and controlling a simulated robot in Gazebo.', 'alias' => 'ros-beginners-guide', 'author' => 'Rajesh Kumar', 'created_at' => now(), 'updated_at' => now()],
            ['title' => 'How Computer Vision Transforms Robotics', 'description' => 'Deep dive into computer vision applications in robotics. Object detection, tracking, SLAM, and real-world case studies of vision-guided robots in industry.', 'alias' => 'computer-vision-robotics', 'author' => 'Priya Sharma', 'created_at' => now(), 'updated_at' => now()],
        ];
        DB::table('blogs')->insert($blogs);

        $this->command->info('Visobotics database seeded successfully!');
    }
}

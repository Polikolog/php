create database db_php;

use db_php;

DROP TABLE IF EXISTS Users;
DROP TABLE IF EXISTS Department;

-- Создание таблицы departments
-- Создание таблицы Department с улучшенными ограничениями
CREATE TABLE Department (
    XML_ID VARCHAR(255) PRIMARY KEY,
    PARENT_XML_ID VARCHAR(255),
    NAME_DEPARTMENT VARCHAR(255) NOT NULL, -- Не позволяет вставлять пустые значения
    FOREIGN KEY (PARENT_XML_ID) REFERENCES Department(XML_ID) ON DELETE SET NULL
);

-- Создание таблицы Users с улучшенными ограничениями
CREATE TABLE Users (
   XML_ID VARCHAR(255) PRIMARY KEY,
   LAST_NAME VARCHAR(255) NOT NULL, -- Не позволяет вставлять пустые значения
   NAME VARCHAR(255) NOT NULL, -- Не позволяет вставлять пустые значения
   SECOND_NAME VARCHAR(255),
   DEPARTMENT VARCHAR(255) NOT NULL, -- Не позволяет вставлять пустые значения
   WORK_POSITION VARCHAR(255),
   EMAIL VARCHAR(255) UNIQUE, -- Гарантирует уникальность значений
   MOBILE_PHONE VARCHAR(20),
   PHONE VARCHAR(20),
   LOGIN VARCHAR(50) UNIQUE, -- Гарантирует уникальность значений
   PASSWORD VARCHAR(50) NOT NULL, -- Не позволяет вставлять пустые значения
   FOREIGN KEY (DEPARTMENT) REFERENCES Department(XML_ID)
);

select * from Department;
select * from Users;
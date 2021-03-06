<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Student
 *
 * @ORM\Table(name="student")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\StudentRepository")
 */
class Student
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="first_name", type="string", length=255)
     * @Assert\NotBlank(message="First name cannot be blank.")
     * @Assert\Regex("/^[a-z]+$/i", message="First name can only contain letters")
     * @Assert\Length(
     *      max = 20,
     *      maxMessage = "First name cannot be longer than {{ limit }} characters"
     * )
     */
    private $firstName;

    /**
     * @ORM\ManyToMany(targetEntity="Relative", inversedBy="students", cascade={"persist"})
     * @ORM\JoinTable(name="relative_student")
     */
    private $relatives;

    /**
     * @var string
     *
     * @ORM\Column(name="last_name", type="string", length=255)
     * @Assert\NotBlank(message="Last name cannot be blank.")
     * @Assert\Regex("/^[a-z]+$/i", message="Last name can only contain letters")
     * @Assert\Length(
     *      max = 20,
     *      maxMessage = "Last name cannot be longer than {{ limit }} characters"
     * )
     */
    private $lastName;

    /**
     * @var string
     *
     * @ORM\Column(name="gender", type="string", length=255)
     * @Assert\NotBlank(message="Gender cannot be blank.")
     * @Assert\Choice(choices = {"male", "female"}, message = "Choose a valid gender.", strict=true)
     */
    private $gender;

    /**
     * @var string
     *
     * @ORM\Column(name="class", type="string", length=255)
     * @Assert\NotBlank(message="Class cannot be blank")
     * @Assert\Choice(choices = {
     *     "lkg", "ukg", "nursery", "1", "2", "3", "4", "5", "6", "7", "8", "9", "10", "11", "12"
     * }, message = "Choose a valid class.", strict=true)
     */
    private $class;

    /**
     * @var string
     *
     * @ORM\Column(name="fathers_name", type="string", length=255)
     * @Assert\NotBlank(message="Father's name cannot be blank.")
     * @Assert\Regex("/^[a-z\s\.]+$/i", message="Father's name can only contain letters, spaces, and '.'")
     * @Assert\Length(
     *      max = 40,
     *      maxMessage = "Father's name cannot be longer than {{ limit }} characters"
     * )
     */
    private $fathersName;

    /**
     * @var string
     *
     * @ORM\Column(name="mothers_name", type="string", length=255)
     * @Assert\NotBlank(message="Mother's name cannot be blank.")
     * @Assert\Regex("/^[a-z\s\.]+$/i", message="Mother's name can only contain letters, spaces, and '.'")
     * @Assert\Length(
     *      max = 40,
     *      maxMessage = "Mother's name cannot be longer than {{ limit }} characters"
     * )
     */
    private $mothersName;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dob", type="date")
     * @Assert\NotBlank(message="Date of birth cannot be blank.")
     * @Assert\Date(message="Date of birth is invalid")
     */
    private $dob;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="joined", type="date")
     * @Assert\NotBlank(message="Joined date cannot be blank.")
     * @Assert\Date(message="Joined date is invalid")
     */
    private $joined;

    /**
     * @var bool
     *
     * @ORM\Column(name="active", type="boolean")
     * @Assert\Type("boolean", message="Active must be boolean")
     */
    private $active;

    /**
     * @var string
     *
     * @ORM\Column(name="address", type="text")
     * @Assert\NotBlank(message="Address cannot be blank")
     * @Assert\Length(
     *      max = 500,
     *      maxMessage = "Mother's name cannot be longer than {{ limit }} characters"
     * )
     */
    private $address;

    /**
     * @var string
     *
     * @ORM\Column(name="parents_occupation", type="string", length=255)
     * @Assert\NotBlank(message="Parent's occupation cannot be blank")
     * @Assert\Length(
     *      max = 40,
     *      maxMessage = "Mother's name cannot be longer than {{ limit }} characters"
     * )
     */
    private $parentsOccupation;

    /**
     * @var int
     *
     * @ORM\Column(name="parents_income", type="integer")
     * @Assert\NotBlank(message="Parent's income cannot be blank")
     * @Assert\Range(
     *      min = 1000,
     *      max = 1000000,
     *      minMessage = "Income be at least {{ limit }} rupees",
     *      maxMessage = "Income cannot be more than {{ limit }} rupees"
     * )
     */
    private $parentsIncome;

    /**
     * @var int
     *
     * @ORM\Column(name="family_type", type="string")
     * @Assert\NotBlank(message="Family type cannot be blank")
     * @Assert\Choice(choices = {
     *     "nuclear", "joint"
     * }, message = "Choose a valid family type.", strict=true)
     */
    private $familyType;

    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set firstName
     *
     * @param string $firstName
     *
     * @return Student
     */
    public function setFirstName($firstName)
    {
        $this->firstName = $firstName;

        return $this;
    }

    /**
     * Get firstName
     *
     * @return string
     */
    public function getFirstName()
    {
        return $this->firstName;
    }

    /**
     * Set lastName
     *
     * @param string $lastName
     *
     * @return Student
     */
    public function setLastName($lastName)
    {
        $this->lastName = $lastName;

        return $this;
    }

    /**
     * Get lastName
     *
     * @return string
     */
    public function getLastName()
    {
        return $this->lastName;
    }

    /**
     * Set gender
     *
     * @param string $gender
     *
     * @return Student
     */
    public function setGender($gender)
    {
        $this->gender = $gender;

        return $this;
    }

    /**
     * Get gender
     *
     * @return string
     */
    public function getGender()
    {
        return $this->gender;
    }

    /**
     * Set class
     *
     * @param string $class
     *
     * @return Student
     */
    public function setClass($class)
    {
        $this->class = $class;

        return $this;
    }

    /**
     * Get class
     *
     * @return string
     */
    public function getClass()
    {
        return $this->class;
    }

    /**
     * Set fathersName
     *
     * @param string $fathersName
     *
     * @return Student
     */
    public function setFathersName($fathersName)
    {
        $this->fathersName = $fathersName;

        return $this;
    }

    /**
     * Get fathersName
     *
     * @return string
     */
    public function getFathersName()
    {
        return $this->fathersName;
    }

    /**
     * Set mothersName
     *
     * @param string $mothersName
     *
     * @return Student
     */
    public function setMothersName($mothersName)
    {
        $this->mothersName = $mothersName;

        return $this;
    }

    /**
     * Get mothersName
     *
     * @return string
     */
    public function getMothersName()
    {
        return $this->mothersName;
    }

    /**
     * Set dob
     *
     * @param \DateTime $dob
     *
     * @return Student
     */
    public function setDob($dob)
    {
        $this->dob = $dob;

        return $this;
    }

    /**
     * Get dob
     *
     * @return \DateTime
     */
    public function getDob()
    {
        return $this->dob;
    }

    /**
     * Set joined
     *
     * @param \DateTime $joined
     *
     * @return Student
     */
    public function setJoined($joined)
    {
        $this->joined = $joined;

        return $this;
    }

    /**
     * Get joined
     *
     * @return \DateTime
     */
    public function getJoined()
    {
        return $this->joined;
    }

    /**
     * Set active
     *
     * @param boolean $active
     *
     * @return Student
     */
    public function setActive($active)
    {
        $this->active = $active;

        return $this;
    }

    /**
     * Get active
     *
     * @return bool
     */
    public function getActive()
    {
        return $this->active;
    }

    /**
     * Set address
     *
     * @param string $address
     *
     * @return Student
     */
    public function setAddress($address)
    {
        $this->address = $address;

        return $this;
    }

    /**
     * Get address
     *
     * @return string
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * Set parentsOccupation
     *
     * @param string $parentsOccupation
     *
     * @return Student
     */
    public function setParentsOccupation($parentsOccupation)
    {
        $this->parentsOccupation = $parentsOccupation;

        return $this;
    }

    /**
     * Get parentsOccupation
     *
     * @return string
     */
    public function getParentsOccupation()
    {
        return $this->parentsOccupation;
    }

    /**
     * Set parentsIncome
     *
     * @param integer $parentsIncome
     *
     * @return Student
     */
    public function setParentsIncome($parentsIncome)
    {
        $this->parentsIncome = $parentsIncome;

        return $this;
    }

    /**
     * Get parentsIncome
     *
     * @return int
     */
    public function getParentsIncome()
    {
        return $this->parentsIncome;
    }

    /**
     * Set familyType
     *
     * @param string $familyType
     *
     * @return Student
     */
    public function setFamilyType($familyType)
    {
        $this->familyType = $familyType;

        return $this;
    }

    /**
     * Get familyType
     *
     * @return string
     */
    public function getFamilyType()
    {
        return $this->familyType;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->relatives = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add relative
     *
     * @param \AppBundle\Entity\Relative $relative
     *
     * @return Student
     */
    public function addRelative(\AppBundle\Entity\Relative $relative)
    {
        $this->relatives[] = $relative;

        return $this;
    }

    /**
     * Remove relative
     *
     * @param \AppBundle\Entity\Relative $relative
     */
    public function removeRelative(\AppBundle\Entity\Relative $relative)
    {
        $this->relatives->removeElement($relative);
    }

    /**
     * Get relatives
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getRelatives()
    {
        return $this->relatives;
    }
}
